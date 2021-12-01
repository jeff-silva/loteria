<?php

namespace App\Formats;

class Html extends Formats {

    public $name = 'HTML';
    public $extension = 'html';
    public $mime = 'text/html';

    public function export($query) {
        $items = $query->get()->toArray();

        $content = ['<!DOCTYPE html><head><meta charset="UTF-8">'];
        $content[] = '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
        $content[] = '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        $content[] = '<title>'. $this->filename() .'</title>';
        $content[] = '</head><body>';
        
        $content[] = '<table style="border:solid 1px #f5f5f5; font-family:monospace;">';

        if (isset($items[0])) {
            $content[] = '<thead>';
            foreach($items[0] as $key => $value) {
                $content[] = "<th style=\"padding:5px; text-align:left;\">{$key}</th>";
            }
            $content[] = '</thead>';
        }

        $content[] = '<tbody>';
        foreach($items as $i=>$fields) {
            $background = $i%2==0? '#f9f9f9': '#ffffff';
            $content[] = "<tr style=\"background:{$background};\">";
            foreach($fields as $key => $value) {
                $content[] = "<td style=\"padding:5px;\">{$value}</td>";
            }
            $content[] = '</tr>';
        }
        $content[] = '</tbody>';
        $content[] = '</table>';
        
        $content[] = '</body></html>';
        return implode("\n", $content);
    }

    public function import() {
        // 
    }
    
}
