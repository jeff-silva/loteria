<?php

namespace App\Models\LoteriaAnalise;

class LoteriaAnalise {
    public $id = false;
    public $title = false;
    public $goods = [];
    public $bads = [];

    public function __construct($items, $type) {
        $this->goods = $this->getGoods($items, $type);
        $this->bads = $this->getBads($items, $type);
    }

    public function getGoods($items, $type) {
        return [];
    }

    public function getBads($items, $type) {
        return [];
    }
}