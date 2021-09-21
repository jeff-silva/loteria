<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppMakeModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criar/alterar models de acordo com modelo do banco';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $this->comment('⚙️  Criando/alterando models');

        $schema = $this->getSchema();
        foreach($schema['tables'] as $table_name=>$table) {
            
            $model = new \stdClass;
            $model->name = (string) \Str::of($table_name)->studly()->kebab()->singular()->studly();
            $model->namespace = "\App\Models\\{$model->name}";
            $model->file = app_path(implode(DIRECTORY_SEPARATOR, ['Models', "{$model->name}.php"]));
            $model->file_exists = !!realpath($model->file);

            
            if (! $model->file_exists) {
                file_put_contents($model->file, implode("\n", [
                    '<?php',
                    '',
                    "namespace App\Models;",
                    '',
                    "class {$model->name} extends \Illuminate\Database\Eloquent\Model",
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

            $content = file_get_contents($model->file);
            $me = $this;

            // Criando protected $fillable
            $content = preg_replace_callback('/protected \$fillable(.+?);/s', function($finds) use($me, $table, $model) {
                $fillable = "'". implode("',\n\t\t'", array_keys($table['Fields'])) ."'";
                return "protected \$fillable = [\n\t\t{$fillable}\n\t];";
            }, $content);

            file_put_contents($model->file, $content);

            // Criando métodos belongsTo e hasMany
            $methods = [];
            $fks = config('database-schema.fks', []);
            foreach($fks as $fk_table=>$fk) {
                if (! $fk['REFERENCED_TABLE_NAME']) continue;

                // hasMany
                if ($fk['REFERENCED_TABLE_NAME']==$table_name) {
                    $methodName = (string) \Str::of($fk['TABLE_NAME'])->camel()->plural();
                    $modelName = (string) '\App\Models\\'. \Str::of($fk['TABLE_NAME'])->studly()->singular();
                    $methods[ $methodName ] = "\tpublic function {$methodName}() {\n\t\treturn \$this->hasMany({$modelName}::class, '{$fk['COLUMN_NAME']}', '{$fk['REFERENCED_COLUMN_NAME']}');\n\t}";
                }

                // belongsTo
                if ($fk['TABLE_NAME']==$table_name) {
                    $methodName = (string) \Str::of($fk['REFERENCED_TABLE_NAME'])->camel()->singular();
                    $modelName = (string) '\App\Models\\'. \Str::of($fk['REFERENCED_TABLE_NAME'])->studly()->singular();
                    $methods[ $methodName ] = "\tpublic function {$methodName}() {\n\t\treturn \$this->belongsTo({$modelName}::class, '{$fk['COLUMN_NAME']}', '{$fk['REFERENCED_COLUMN_NAME']}');\n\t}";
                }
            }

            foreach($methods as $method_name=>$method_content) {
                $this->classWriteMethod($model->namespace, $method_name, $method_content, $model->file);
            }
        }
    }


    public function getSchema() {
        $database_schema = [
            'tables' => [],
            'fks' => [],
        ];

        foreach(\DB::select('SHOW TABLE STATUS') as $table) {
            
            $statement = collect(\DB::select("SHOW CREATE TABLE `{$table->Name}`;"))->pluck('Create Table')->first();
            $statement = str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS', $statement);
            $table->Create = str_replace("\n", '', $statement);
            
            $table->Fields = [];
            foreach(\DB::select("SHOW COLUMNS FROM {$table->Name}") as $col) {
                $col->Query = $this->getFieldSchema($col);
                $table->Fields[ $col->Field ] = $col;
            }
            $database_schema['tables'][ $table->Name ] = $table;
        }

        $database = env('DB_DATABASE');
        foreach(\DB::select("SELECT * FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE CONSTRAINT_SCHEMA='{$database}' AND CONSTRAINT_NAME != 'PRIMARY' ") as $fk) {
            $database_schema['fks'][ $fk->CONSTRAINT_NAME ] = $fk;
        }

        return json_decode(json_encode($database_schema), true);
    }


    public function getFieldSchema($field) {
        $field = (array) $field;
        $schema = [ $field['Type'] ];
        $schema[] = (($field['Null']=='NO' || $field['Key']=='PRI')? 'NOT NULL': 'NULL');
        if ($field['Extra']=='auto_increment') $schema[] = 'AUTO_INCREMENT';
        if ($field['Key'] != 'PRI' AND !str_contains($field['Type'], 'varchar') AND !str_contains($field['Type'], 'int') AND $field['Type']!='longtext' AND $field['Type']!='timestamp') {
            $schema[] = ($field['Default']===NULL? 'DEFAULT NULL': "DEFAULT '{$field['Default']}'");
        }
        return implode(' ', $schema);
    }


    public function varExport($data) {
        $dump = var_export($data, true);
        $dump = preg_replace('#(?:\A|\n)([ ]*)array \(#i', '[', $dump); // Starts
        $dump = preg_replace('#\n([ ]*)\),#', "\n$1],", $dump); // Ends
        $dump = preg_replace('#=> \[\n\s+\],\n#', "=> [],\n", $dump); // Empties
        if (gettype($data) == 'object') { // Deal with object states
            $dump = str_replace('__set_state(array(', '__set_state([', $dump);
            $dump = preg_replace('#\)\)$#', "])", $dump);
        }
        else {  $dump = preg_replace('#\)$#', "]", $dump); }
        return $dump;
    }

    public function classSource($class) {
        if (is_string($class)) {
            $class = app($this->Model->Namespace);
        }

        $class = new \ReflectionClass($class);
        $fileName = $class->getFileName();
        $startLine = $class->getStartLine()-1;
        $endLine = $class->getEndLine();
        $numLines = $endLine - $startLine;
        $fileContents = null;

        if(!empty($fileName)) {
            $fileContents = file_get_contents($fileName);
            $classSource = trim(implode('', array_slice(file($fileName), $startLine, $numLines))); // not perfect; if the class starts or ends on the same line as something else, this will be incorrect
            // $hash = crc32($classSource);
        }
        
        return $fileContents;
    }

    public function classWriteMethod($class, $method_name, $method_content, $filename) {
        if (is_string($class)) {
            $class = app($class);
        }

        $source = $this->classSource($class);

        if (method_exists($class, $method_name)) {
            // $source = preg_replace("/\t+public function {$method_name}(.+?)\}/s", $method_content, $source);
        }
        else {
            $source = rtrim(rtrim($source), '}') ."\n{$method_content}\n}";
        }

        file_put_contents($filename, $source);
    }
}
