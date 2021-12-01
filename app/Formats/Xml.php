<?php

namespace App\Formats;

class Xml extends Formats {

    public $name = 'XML';
    public $extension = 'xml';
    public $mime = 'application/xml';

    public function export($query) {
        $items = $query->get()->toArray();
        $content = ['<?xml version="1.0"?>', '<items>'];

        foreach($items as $item) {
            $content[] = "\t<item>";

            foreach($item as $key => $value) {
                $content[] = "\t\t<{$key}>{$value}</{$key}>";
            }

            $content[] = "\t</item>";
        }

        $content[] = '</items>';
        return implode("\n", $content);
    }

    public function import() {
        // 
    }

}