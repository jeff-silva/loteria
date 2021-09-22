<?php

namespace App\Console\Commands;

class AppDbImport extends \Illuminate\Console\Command
{
    protected $signature = 'app:db-import';
    protected $description = 'Importa schema.sql';

    public function handle()
    {   
        // if ($schema = realpath(database_path('schema.sql'))) {
        //     \DB::unprepared(file_get_contents($schema));
        //     $this->comment('⚙️ Importando schema.sql');
        // }

        $schema = config('database-schema');

        if (! $schema) {
            $this->error("Os dados de config/database-schema.php estão vazios.\nPara gerá-los, execute 'php artisan app:db-export'\nou limpe o cache executando 'php artisan optimize'");
            return;
        }

        foreach($schema['tables'] as $table_name => $table) {
            if (\Schema::hasTable($table_name)) {
                foreach($table['Fields'] as $field_name => $field) {
                    if (\Schema::hasColumn($table_name, $field_name)) {
                        // \DB::statement("ALTER TABLE `{$table_name}` MODIFY COLUMN `{$field_name}` {$field['Query']};");
                    }
                    else {
                        $this->comment("criando coluna {$table_name}.{$field_name}");
                        \DB::statement("ALTER TABLE `{$table_name}` ADD COLUMN `{$field_name}` {$field['Query']};");
                    }
                }
            }

            else {
                $this->comment("criando tabela {$table_name}");
                \DB::statement($table['Create']);
            }
        }
    }
}
