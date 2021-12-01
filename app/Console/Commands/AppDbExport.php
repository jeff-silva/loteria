<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppDbExport extends AppBase
{
    protected $signature = 'app:db-export';
    protected $description = 'Exporta estrutura do banco de dados para o arquivo config/database-schema.php';

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
    

    public function getSchema() {
        $database_schema = [
            'tables' => [],
            'fks' => [],
        ];

        foreach(\DB::select('SHOW TABLE STATUS') as $table) {
            $deletes = [
                'Version', 'Row_format', 'Rows', 'Avg_row_length', 'Data_length', 'Max_data_length', 'Index_length',
                'Data_free', 'Create_time', 'Update_time', 'Check_time', 'Checksum', 'Create_options',
            ];
            foreach($deletes as $delete) {
                unset($table->$delete);
            }

            $table->Model = ((string) \Str::of($table->Name)->slug()->studly());
            $table->ModelNamespace = '\App\Models';
            $table->ModelFile = '\app\Models\\'. ((string) \Str::of($table->Name)->slug()->studly()) .'.php';
            
            if ($table->Name=='users') {
                $table->Model = ((string) \Str::of($table->Name)->slug()->singular()->studly());
                $table->ModelNamespace = '\App\Models';
                $table->ModelFile = '\app\Models\\'. ((string) \Str::of($table->Name)->slug()->singular()->studly()) .'.php';
            }

            $table->Controller = ((string) \Str::of($table->Name)->slug()->studly()) .'Controller';
            $table->ControllerNamespace = '\App\Http\Controllers';
            $table->ControllerFile = '\app\Http\Controllers\\'. ((string) \Str::of($table->Name)->slug()->studly()) .'Controller.php';

            $statement = collect(\DB::select("SHOW CREATE TABLE `{$table->Name}`;"))->pluck('Create Table')->first();
            $statement = str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS', $statement);
            $table->Sql = str_replace(["\n", "\t"], '', $statement);
            
            $table->Fields = [];
            foreach(\DB::select("SHOW COLUMNS FROM {$table->Name}") as $col) {
                $col->Sql = $this->getFieldSchema($col);
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
}
