<?php

namespace App\Models\LoteriaAnalise;

class LoteriaAnaliseCentral extends LoteriaAnalise {
    public $id = 'central';
    public $title = 'Áreas mais/menos sorteadas por lógica central';

    public function getGoods($items, $type) {
        $numbers = array_map(function($number) {
            return str_pad($number, 2, '0', STR_PAD_LEFT);
        }, range(1, $type['numbersTotal']));

        $numbers = array_chunk($numbers, $type['numbersLine']);

        // remove first line
        unset($numbers[0]);

        // remove last line
        unset($numbers[ sizeof($numbers) ]);

        // remove first and last element every field
        foreach($numbers as $i => $numbs) {
            unset($numbers[ $i ][0]);
            unset($numbers[ $i ][ sizeof($numbs)-1 ]);
        }

        $return = [];
        foreach($numbers as $numbs) {
            foreach($numbs as $number) {
                $return[] = $number;
            }
        }

        return $return;
    }

    public function getBads($items, $type) {
        $numbers = array_map(function($number) {
            return str_pad($number, 2, '0', STR_PAD_LEFT);
        }, range(1, $type['numbersTotal']));

        $numbers = array_chunk($numbers, $type['numbersLine']);
        foreach($numbers as $i => $numbs) {
            if ($i==0 OR $i==sizeof($numbers)-1) { continue; }
            foreach($numbs as $ii=>$number) {
                if ($ii==0 OR $ii==sizeof($numbs)-1) { continue; }
                unset($numbers[ $i ][ $ii ]);
            }
        }

        $return = [];
        foreach($numbers as $numbs) {
            foreach($numbs as $number) {
                $return[] = $number;
            }
        }

        return $return;
    }
}