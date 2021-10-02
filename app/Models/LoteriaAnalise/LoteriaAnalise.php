<?php

// Analisa sequencia de números simulado para aposta
namespace App\Models\LoteriaAnalise;

class LoteriaAnalise {
    
    public $label = false;

    public static function getTipos() {
        return [
            new LoteriaAnaliseTest,
        ];
    }

    public static function getAnalises($type, $sorteios=[]) {
        $return = [
            'items' => [],
        ];

        foreach(self::getTipos() as $tipoAnalise) {
            $return['items'][] = $tipoAnalise;
        }
        
        return $return;
    }

    public function getAnalise($type, $sorteios=[], $numbers=[]) {
        $loteria = \App\Models\Loteria::getInstance($type);
        return [];
    }
}