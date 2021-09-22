<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppDbExport extends Command
{
    protected $signature = 'app:db-export';
    protected $description = 'Exporta banco de dados para schema.sql';

    public function handle()
    {   
        $this->comment('⚙️  Gerando config/database-schema.php');
        $database_schema = $this->getSchema();
        
        file_put_contents(config_path('database-schema.php'), implode("\n\n", [
            '<?php',
            "/* Para gerar este arquivo, execute 'php artisan app:db-export'\nPara criar tabelas e colunas, execute 'php artisan app:db-import' */",
            ('return '. $this->varExport($database_schema) .';'),
        ]));
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
}
