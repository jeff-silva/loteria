<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppLoteriaImport extends Command
{
    protected $signature = 'app:loteria-import';
    protected $description = 'Importa números do site da caixa';

    public function handle() {
        // $this->comment('test');

        foreach((new \App\Models\LoteriaSorteioBase)->tiposAposta() as $tipo) {
            if ($tipoAposta = \App\Models\LoteriaSorteioBase::getInstance($tipo->type['id'])) {
                $tipoAposta->import();
            }
        }
    }
}
