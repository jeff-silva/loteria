<?php

namespace App\Formats;

class Formats {

    public $name = 'Default';
    public $extension = 'json';
    public $mime = 'application/json';

    public function filename() {
        return uniqid('download-') .'.'. $this->extension;
    }

    public function mime() {
        return $this->mime;
    }

    public function export($query) {
        return json_encode($query->get());
    }

    public function import() {
        // 
    }

    static function all() {
        $return = [];

        foreach(\File::allFiles(__DIR__) as $file) {
            if ('Formats'==$file->getFilenameWithoutExtension()) continue;
            $return[] = app('\App\Formats\\'. $file->getFilenameWithoutExtension());
        }
        
        return $return;
    }
}