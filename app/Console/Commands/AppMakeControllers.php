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
                    "/* Routes examples",
                    "Route::get('{$table['Name']}/search', 'App\Http\Controllers\\{$table['Controller']}@search');",
                    "Route::get('{$table['Name']}/find/{id}','App\Http\Controllers\\{$table['Controller']}@find');",
                    "Route::post('{$table['Name']}/save', 'App\Http\Controllers\\{$table['Controller']}@save');",
                    "Route::post('{$table['Name']}/valid', 'App\Http\Controllers\\{$table['Controller']}@valid');",
                    "Route::post('{$table['Name']}/remove', 'App\Http\Controllers\\{$table['Controller']}@remove');",
                    "Route::get('{$table['Name']}/clone/{id}','App\Http\Controllers\\{$table['Controller']}@clone');",
                    "Route::get('{$table['Name']}/export', 'App\Http\Controllers\\{$table['Controller']}@export');",
                    "*/",
                    '',
                    "class {$table['Controller']} extends Controller",
                    '{',
                    '',
                    "\tpublic function __construct() {",
                    "\t\t\$this->middleware('auth:api', [",
                    "\t\t\t'except' => [],",
                    "\t\t]);",
                    "\t}",
                    '}',
                ]));
            }

            $methods = [];

            $methods['search'] = implode("\n", [
                "\tpublic function search() {",
                "\t\treturn {$table['ModelNamespace']}\\{$table['Model']}::search()->paginate(request('per_page', 10));",
                "\t}",
            ]);

            $methods['find'] = implode("\n", [
                "\tpublic function find(\$id) {",
                "\t\treturn {$table['ModelNamespace']}\\{$table['Model']}::find(\$id);",
                "\t}",
            ]);

            $methods['save'] = implode("\n", [
                "\tpublic function save() {",
                "\t\treturn (new {$table['ModelNamespace']}\\{$table['Model']})->store(request()->all());",
                "\t}",
            ]);

            $methods['valid'] = implode("\n", [
                "\tpublic function valid() {",
                "\t\treturn {$table['ModelNamespace']}\\{$table['Model']}::new()->validate(request()->all());",
                "\t}",
            ]);

            $methods['remove'] = implode("\n", [
                "\tpublic function remove(\$id) {",
                "\t\treturn {$table['ModelNamespace']}\\{$table['Model']}::search()->remove();",
                "\t}",
            ]);

            $methods['clone'] = implode("\n", [
                "\tpublic function clone(\$id) {",
                "\t\treturn {$table['ModelNamespace']}\\{$table['Model']}::find(\$id)->clone();",
                "\t}",
            ]);

            $methods['export'] = implode("\n", [
                "\tpublic function export() {",
                "\t\treturn {$table['ModelNamespace']}\\{$table['Model']}::search()->export(export('format', 'csv'));",
                "\t}",
            ]);

            foreach($methods as $method_name=>$method_content) {
                $this->classWriteMethod("{$table['ControllerNamespace']}\\{$table['Controller']}", $method_name, $method_content);
            }
        }

    }
}
