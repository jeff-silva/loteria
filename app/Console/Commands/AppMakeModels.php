<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppMakeModels extends AppBase
{

    protected $signature = 'app:make-models';
    protected $description = 'Criar/alterar models de acordo com tabelas no banco de dados';

    public function handle()
    {
        $this->comment('⚙️  Criando/alterando models');

        $schema = config('database-schema', []);

        foreach($schema['tables'] as $table_name=>$table) {
            
            if (! file_exists(base_path($table['ModelFile']))) {
                file_put_contents(base_path($table['ModelFile']), implode("\n", [
                    '<?php',
                    '',
                    "namespace App\Models;",
                    '',
                    "class {$table['Model']} extends \Illuminate\Database\Eloquent\Model",
                    '{',
                    "\tuse \App\Traits\Model;",
                    '',
                    "\tprotected \$fillable = [\n\t\t'". implode("',\n\t\t'", array_keys($table['Fields'])) ."',\n\t];",
                    '',
                    "\tpublic function validate(\$data=[]) {",
                    "\t\treturn \Validator::make(\$data, [",
                    "\t\t\t'name' => ['required'],",
                    "\t\t]);",
                    "\t}",
                    '}',
                ]));
            }

            $content = file_get_contents(base_path($table['ModelFile']));
            $me = $this;
            
            // Criando protected $fillable
            $content = preg_replace_callback('/protected \$fillable(.+?);/s', function($finds) use($me, $table) {
                $fillable = "'". implode("',\n\t\t'", array_keys($table['Fields'])) ."'";
                return "protected \$fillable = [\n\t\t{$fillable}\n\t];";
            }, $content);
            
            file_put_contents(base_path($table['ModelFile']), $content);
            
            // Criando métodos belongsTo e hasMany
            $methods = [];
            $fks = config('database-schema.fks', []);
            foreach($fks as $fk_table=>$fk) {
                if (! $fk['REFERENCED_TABLE_NAME']) continue;

                // hasMany
                if ($fk['REFERENCED_TABLE_NAME']==$table_name) {
                    $methodName = (string) \Str::of($fk['TABLE_NAME'])->camel()->plural();
                    $modelName = "{$table['ModelNamespace']}\\{$table['Model']}";
                    $methods[ $methodName ] = "\tpublic function {$methodName}() {\n\t\treturn \$this->hasMany({$modelName}::class, '{$fk['COLUMN_NAME']}', '{$fk['REFERENCED_COLUMN_NAME']}');\n\t}";
                }

                // belongsTo
                if ($fk['TABLE_NAME']==$table_name) {
                    $methodName = (string) \Str::of($fk['REFERENCED_TABLE_NAME'])->camel()->singular();
                    $modelName = "{$table['ModelNamespace']}\\{$table['Model']}";
                    $methods[ $methodName ] = "\tpublic function {$methodName}() {\n\t\treturn \$this->belongsTo({$modelName}::class, '{$fk['COLUMN_NAME']}', '{$fk['REFERENCED_COLUMN_NAME']}');\n\t}";
                }
            }

            foreach($methods as $method_name=>$method_content) {
                $this->classWriteMethod("{$table['ModelNamespace']}\\{$table['Model']}", $method_name, $method_content);
            }
        }
    }
}
