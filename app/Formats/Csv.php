<?php

namespace App\Formats;

class Csv extends Formats {

    public $name = 'Planilha CSV';
    public $extension = 'csv';
    public $mime = 'text/csv';

    public function export($query) {
        $content = [];

        foreach($query->get()->toArray() as $line) {
            $content[] = implode(",", $line);
        }

        return implode("\n", $content);
    }

    public function import() {
        // 
    }
    
}