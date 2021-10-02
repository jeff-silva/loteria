<?php

namespace App\Models\LoteriaProbabilidade;

class LoteriaProbabilidadeUltimos extends LoteriaProbabilidade {
    
    public $label = 'Últimos 3 sorteios';
    
    public function getBads($type, $sorteios=[]) {
        $last_size = 3;

        foreach($sorteios as $i => $sorteio) {

            $lasts = [];
            for($ii=1; $ii<=$last_size; $ii++) {
                $lasts[$ii] = isset($sorteios[$i-$ii])? $sorteios[$i-$ii]: false;
            }

            if ($last_size != sizeof(array_filter($lasts))) continue;

            $numbers = [];
            foreach($lasts as $last) {
                foreach($last->numbers as $number) {
                    $number = strval($number);
                    if (! isset($numbers[$number])) {
                        $numbers[$number] = [
                            'number' => $number,
                            'quant' => 0,
                        ];
                    }
                    $numbers[$number]['quant']++;
                }
            }

            $numbers = array_filter($numbers, function($number) {
                return $number['quant'] > 1;
            });
            
            usort($numbers, function($a, $b) {
                return $b['quant'] - $a['quant'];
            });
        }

        return collect($numbers)->pluck('number')->toArray();
    }
}