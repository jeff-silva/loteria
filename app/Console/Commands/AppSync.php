<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppSync extends AppBase
{
    protected $signature = 'app:sync';
    protected $description = 'Sincroniza arquivos entre projeto atual e projeto configurado no .env (SYNC_PATH="C:\\folder\\project")';

    public function handle()
    {
        $this->call('config:clear');
        $this->comment('');

        $sync_path = env('SYNC_PATH');
        if (! $sync_path) {
            $this->error("⚠  SYNC_PATH vazio");
            return;
        }

        $commands = [
            (object) ['command' => 'commandReplace', 'file' => '.env.example'],
            (object) ['command' => 'commandReplace', 'file' => 'app/Console/Commands'],
            (object) ['command' => 'commandReplace', 'file' => 'app/Http/Controllers/Controller.php'],
            (object) ['command' => 'commandReplace', 'file' => 'app/Traits'],
            (object) ['command' => 'commandReplace', 'file' => 'app/Formats'],
            (object) ['command' => 'commandReplace', 'file' => 'database/migrations'],
            (object) ['command' => 'commandReplace', 'file' => 'serve.js'],
            (object) ['command' => 'commandReplace', 'file' => 'client/app.js'],
            (object) ['command' => 'commandReplace', 'file' => 'client/app.scss'],
            (object) ['command' => 'commandReplace', 'file' => 'client/plugins/helpers.js'],
            (object) ['command' => 'commandReplace', 'file' => 'client/pages/dev'],
            (object) ['command' => 'commandReplace', 'file' => 'client/pages/admin/settings.vue'],
            (object) ['command' => 'commandReplace', 'file' => 'client/pages/admin/settings/email.vue'],
            (object) ['command' => 'commandReplace', 'file' => 'client/pages/admin/settings/files.vue'],
            (object) ['command' => 'commandReplace', 'file' => 'client/pages/admin/settings/index.vue'],
            (object) ['command' => 'commandReplace', 'file' => 'client/components/ui'],
        ];

        $commands2 = [];
        foreach($commands as $i => $comm) {
            $comm->ext = pathinfo($comm->file, PATHINFO_EXTENSION);

            if (! $comm->ext) {
                foreach(\File::allFiles(base_path($comm->file)) as $file) {
                    $filepath = $file->getPath() .'/'. $file->getBasename();
                    $filepath = str_replace(base_path(), '', $filepath);
                    $filepath = ltrim(preg_replace('/\\\|\//', DIRECTORY_SEPARATOR, $filepath), DIRECTORY_SEPARATOR);

                    $commands2[] = (object) ['command' => $comm->command, 'file' => $filepath];
                }
                continue;
            }

            $commands2[] = $comm;
        }

        // define from/to
        foreach($commands2 as $comm) {
            $comm->here = base_path($comm->file);
            $comm->here_modified = (file_exists($comm->here)? \File::lastModified($comm->here): null);

            $comm->there = rtrim($sync_path, '/') .'/'. ltrim($comm->file, '/');
            $comm->there_modified = (file_exists($comm->there)? \File::lastModified($comm->there): null);

            call_user_func([$this, $comm->command], $comm);
        }

        $this->comment('🎉 Finalizado');
    }

    public function commandReplace($comm) {
        if (!$comm->here_modified) {
            $this->comment("❌ {$comm->here} não existe");
            return;
        }

        if (!$comm->there_modified) {
            $folder = pathinfo($comm->there, PATHINFO_DIRNAME);
            if (!file_exists($folder)) { mkdir($folder, 0777, true); }
            copy($comm->here, $comm->there);
            $this->comment("⇈  {$comm->here}");
        }

        $comm->here_content = file_get_contents($comm->here);
        $comm->there_content = file_get_contents($comm->there);

        if ($comm->here_content==$comm->there_content) {
            // $this->comment("✅ {$comm->file}");
            return;
        }
        
        if ($comm->here_modified > $comm->there_modified) {
            file_put_contents($comm->there, $comm->here_content);
            $this->comment("⇈  {$comm->here}");
        }

        else {
            file_put_contents($comm->here, $comm->there_content);
            $this->comment("⇊  {$comm->there}");
        }
    }
}
