<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppLoteriaImport extends Command
{
    protected $signature = 'app:loteria-import';
    protected $description = 'Importa números do site da caixa';

    public function handle() {
        // $this->comment('test');

        foreach((new \App\Models\Loteria)->tiposAposta() as $tipo) {
            if ($tipoAposta = \App\Models\Loteria::getInstance($tipo->type['id'])) {
                $tipoAposta->import();
            }
        }
    }
}
