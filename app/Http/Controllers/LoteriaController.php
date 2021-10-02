<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class LoteriaController extends BaseController
{
    public function index() {
        $data = [];

        $tiposAposta = (new \App\Models\LoteriaLotofacil)->tiposAposta();
        foreach($tiposAposta as $tipoAposta) {
            if ($type = request($tipoAposta->type['id'])) {
                $tipoAposta->import();
            }
        }

        $data['tiposAposta'] = $tiposAposta;
        return \Inertia\Inertia::render('loteria', $data);
    }

    public function loteriaParams($merge=[]) {
        $merge = array_merge([
            'type' => 'megasena',
            'numbers' => [],
            'min' => null,
            'max' => null,
        ], request()->all(), $merge);

        $loteria = \App\Models\Loteria::getInstance($merge['type']);
        $merge['min'] = $merge['min']? $merge['min']: $loteria->min('id');
        $merge['max'] = $merge['max']? $merge['max']: $loteria->max('id');

        if (! is_array($merge['numbers'])) {
            $merge['numbers'] = preg_split('/[^0-9]/', $merge['numbers']);
            $merge['numbers'] = array_map(function($number) {
                return str_pad($number, 2, '0', STR_PAD_LEFT);
            }, $merge['numbers']);
        }
        
        return $merge;
    }
    
    public function loteriaView($type) {
        $data['params'] = $this->loteriaParams([
            'type' => $type,
        ]);


        if (1 == request('import') AND $model = \App\Models\Loteria::getInstance($type)) {
            $model->import();
            return redirect()->back();
        }
        

        // if ($model = \App\Models\Loteria::getInstance($type)) {
        //     if (request('import')) {
        //         $model->import();
        //         return redirect()->back();
        //     }

        //     $data['selectedNumbers'] = request('selectedNumbers', []);
        //     if (! is_array($data['selectedNumbers'])) {
        //         $data['selectedNumbers'] = explode('-', $data['selectedNumbers']);
        //     }

        //     $data['type'] = $model->type;
        // }

        return \Inertia\Inertia::render('loteria-view', $data);
    }

    public function analise() {
        $params = $this->loteriaParams();

        $loteria = \App\Models\Loteria::getInstance($params['type']);
        $data['tipoSorteio'] = $loteria->type;

        $sorteios = $loteria
            ->where('number', '>=', $params['min'])
            ->where('number', '<=', $params['max'])
            ->orderBy('id', 'desc')
            ->get();

        $data['numbersTable'] = array_chunk(array_map(function($number) {
            return str_pad($number, 2, '0', STR_PAD_LEFT);
        }, range(1, $data['tipoSorteio']['numbersTotal'])), $data['tipoSorteio']['numbersLine']);

        $data['probabilidades'] = \App\Models\LoteriaProbabilidade\LoteriaProbabilidade::getAnalises($params['type'], $sorteios);
        $data['analise'] = \App\Models\LoteriaAnalise\LoteriaAnalise::getAnalises($params['type'], $sorteios, $params['numbers']);
        $data['sorteios'] = $sorteios;

        return $data;
    }
}

// if (! function_exists('ddd')) {
//     function ddd() {
//         foreach(func_get_args() as $data) { dump($data); }
//         $lines = [];
//         $lines[] = 'document.querySelectorAll(".sf-dump-str-collapse").forEach(item => { console.log(item); });';
//         $lines[] = 'document.querySelectorAll(".sf-dump-compact").forEach(item => { item.className = "sf-dump-expanded"; });';
//         echo "<script>\n". implode("\n", $lines) ."\n</script>"; die;
//     }
// }