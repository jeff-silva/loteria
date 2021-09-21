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
    
    public function loteriaView($type) {
        $data = [];

        if ($model = \App\Models\LoteriaSorteioBase::getInstance($type)) {
            $data['type'] = $model->type;
            $data['items'] = $model->orderBy('id', 'desc')->get();
        }

        return \Inertia\Inertia::render('loteria-view', $data);
    }
}
