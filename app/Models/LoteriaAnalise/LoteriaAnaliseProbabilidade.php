<?php

namespace App\Models\LoteriaAnalise;

class LoteriaAnaliseProbabilidade extends LoteriaAnalise {
    public $id = 'probabilidade';
    public $title = 'Análise de probabilidade últimos 5 jogos';

    public function getBads($items, $type) {
        $lasts = 5;
        $numbers = [];

        foreach($items as $index => $item) {
            if ($index >= $lasts) break;
            foreach($item->getNumbers() as $number) {
                $number = strval($number);
                if (! isset($numbers[ $number ])) {
                    $numbers[ $number ] = 0;
                }
                $numbers[ $number ]++;
            }
        }

        return array_map('strval', array_keys(array_filter($numbers, function($n) {
            return $n > 1;
        })));
    }
}