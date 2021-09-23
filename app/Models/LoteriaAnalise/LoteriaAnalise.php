<?php

namespace App\Models\LoteriaAnalise;

class LoteriaAnalise {
    public $id = false;
    public $title = false;
    public $goods = [];
    public $bads = [];

    public function __construct($items) {
        $this->goods = $this->getGoods($items);
        $this->bads = $this->getBads($items);
    }

    public function getGoods($items) {
        return [];
    }

    public function getBads($items) {
        return [];
    }

}