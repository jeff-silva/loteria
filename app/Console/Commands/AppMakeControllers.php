<?php

namespace App\Console\Commands;

class AppMakeControllers extends AppBase
{

    protected $signature = 'app:make-controllers';
    protected $description = 'Criar/alterar controllers de acordo com tabelas no banco de dados';

    public function handle()
    {
        $this->comment('⚙️  Criando/alterando controllers');

        $tables = config('database-schema.tables', []);

        foreach($tables as $table_name=>$table) {

            if (! file_exists(base_path($table['ControllerFile']))) {
                file_put_contents(base_path($table['ControllerFile']), implode("\n", [
                    '<?php',
                    '',
                    "namespace App\Http\Controllers;",
                    '',
                    "class {$table['Controller']} extends Controller",
                    '{',
                    '',
                    "\tpublic function __construct() {",
                    "\t\t\$this->model = new {$table['ModelNamespace']}\\{$table['Model']};",
                    "\t\t\$this->middleware('auth:api', [",
                    "\t\t\t'except' => [],",
                    "\t\t]);",
                    "\t}",
                    "\t",
                    '}',
                ]));
            }
        }
    }
}
