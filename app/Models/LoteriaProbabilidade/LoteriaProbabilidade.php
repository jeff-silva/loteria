<?php

// Analisa números bons e ruins para jogar
namespace App\Models\LoteriaProbabilidade;

class LoteriaProbabilidade {
    
    public static function getTipos() {
        return [
            new LoteriaProbabilidadeUltimos,
            new LoteriaProbabilidadeCentral,
        ];
    }

    public static function getAnalises($type, $sorteios=[]) {
        $return = [
            'goods' => [],
            'bads' => [],
            'items' => [],
        ];
        foreach(self::getTipos() as $tipoAnalise) {
            $tipoAnalise->goods = $tipoAnalise->getGoods($type, $sorteios);
            $tipoAnalise->bads = $tipoAnalise->getBads($type, $sorteios);
            $return['items'][] = $tipoAnalise;
        }
        return $return;
    }

    public $label = false;
    public $goods = [];
    public $bads = [];

    public function getAnalise($type, $sorteios=[]) {
        $loteria = \App\Models\Loteria::getInstance($type);
        return $this;
    }

    public function getGoods($type, $sorteios=[]) {
        $loteria = \App\Models\Loteria::getInstance($type);
        return [];
    }

    public function getBads($type, $sorteios=[]) {
        $loteria = \App\Models\Loteria::getInstance($type);
        return [];
    }

}