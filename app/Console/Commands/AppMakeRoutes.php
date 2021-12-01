<?php

namespace App\Console\Commands;

class AppMakeRoutes extends AppBase
{
    protected $signature = 'app:make-routes';
    protected $description = 'Gera rotas de API e salva em routes/api_generated.php';

    public function handle()
    {   
        $this->call('config:clear');
        $tables = config('database-schema.tables', []);

        $data = ['<?php', ''];
        $data[] = '/* Este arquivo é gerado, NÃO EXITE-O DIRETAMENTE';
        $data[] = 'Para gerá-lo, execute "php artisan app:make-routes"';
        $data[] = 'ou "php artisan app:dev" para gerar todos os arquivos. */';
        $data[] = '';

        foreach($tables as $table_name=>$table) {
            $data[] = "\App\Http\Controllers\\{$table['Controller']}::router();";
        }
        
        $data[] = '';
        $data[] = 'return [';

        $appRoutes['test'] = ['route'=>'test', 'method'=>'get', 'function'=>'test'];
        $appRoutes['login'] = ['route'=>'login', 'method'=>'post', 'function'=>'login'];
        $appRoutes['logout'] = ['route'=>'logout', 'method'=>'post', 'function'=>'logout'];
        $appRoutes['refresh'] = ['route'=>'refresh', 'method'=>'post', 'function'=>'refresh'];
        $appRoutes['me'] = ['route'=>'me', 'method'=>'post', 'function'=>'me'];
        $appRoutes['register'] = ['route'=>'register', 'method'=>'post', 'function'=>'register'];
        $appRoutes['endpoints'] = ['route'=>'endpoints', 'method'=>'get', 'function'=>'endpoints'];
        $appRoutes['password-reset-start'] = ['route'=>'password-reset-start', 'method'=>'post', 'function'=>'passwordResetStart'];
        $appRoutes['password-reset-change'] = ['route'=>'password-reset-change', 'method'=>'post', 'function'=>'passwordResetChange'];
        $appRoutes['email-test'] = ['route'=>'email-test', 'method'=>'post', 'function'=>'emailTest'];
        $appRoutes['emails-templates'] = ['route'=>'emails-templates', 'method'=>'get', 'function'=>'emailsTemplates'];
        $appRoutes['upload'] = ['route'=>'upload', 'method'=>'post', 'function'=>'upload'];

        foreach($appRoutes as $name => $appRoute) {
            $data[] = "\t'{$name}' => [";
            $data[] = "\t\t'call' => ['Illuminate\Support\Facades\Route', '{$appRoute['method']}'],";
            $data[] = "\t\t'params' => ['{$appRoute['route']}', 'App\Http\Controllers\AppController@{$appRoute['function']}'],";
            $data[] = "\t],";
        }

        
        foreach($tables as $table_name=>$table) {
            $table_route = (string) \Str::of($table_name)->studly()->kebab();

            $data[] = "\t'{$table_name}_search' => [";
            $data[] = "\t\t'call' => ['Illuminate\Support\Facades\Route', 'get'],";
            $data[] = "\t\t'params' => ['{$table_route}/search', 'App\Http\Controllers\\{$table['Controller']}@search'],";
            $data[] = "\t],";

            $data[] = "\t'{$table_name}_find' => [";
            $data[] = "\t\t'call' => ['Illuminate\Support\Facades\Route', 'get'],";
            $data[] = "\t\t'params' => ['{$table_route}/find/{id}', 'App\Http\Controllers\\{$table['Controller']}@find'],";
            $data[] = "\t],";

            $data[] = "\t'{$table_name}_save' => [";
            $data[] = "\t\t'call' => ['Illuminate\Support\Facades\Route', 'post'],";
            $data[] = "\t\t'params' => ['{$table_route}/save', 'App\Http\Controllers\\{$table['Controller']}@save'],";
            $data[] = "\t],";

            $data[] = "\t'{$table_name}_valid' => [";
            $data[] = "\t\t'call' => ['Illuminate\Support\Facades\Route', 'post'],";
            $data[] = "\t\t'params' => ['{$table_route}/valid', 'App\Http\Controllers\\{$table['Controller']}@valid'],";
            $data[] = "\t],";

            $data[] = "\t'{$table_name}_remove' => [";
            $data[] = "\t\t'call' => ['Illuminate\Support\Facades\Route', 'post'],";
            $data[] = "\t\t'params' => ['{$table_route}/remove', 'App\Http\Controllers\\{$table['Controller']}@remove'],";
            $data[] = "\t],";

            $data[] = "\t'{$table_name}_clone' => [";
            $data[] = "\t\t'call' => ['Illuminate\Support\Facades\Route', 'post'],";
            $data[] = "\t\t'params' => ['{$table_route}/clone/{id}', 'App\Http\Controllers\\{$table['Controller']}@clone'],";
            $data[] = "\t],";

            $data[] = "\t'{$table_name}_import' => [";
            $data[] = "\t\t'call' => ['Illuminate\Support\Facades\Route', 'post'],";
            $data[] = "\t\t'params' => ['{$table_route}/import', 'App\Http\Controllers\\{$table['Controller']}@import'],";
            $data[] = "\t],";

            $data[] = "\t'{$table_name}_export' => [";
            $data[] = "\t\t'call' => ['Illuminate\Support\Facades\Route', 'get'],";
            $data[] = "\t\t'params' => ['{$table_route}/export', 'App\Http\Controllers\\{$table['Controller']}@export'],";
            $data[] = "\t],";
        }

        $data[] = '];';

        $content = implode("\n", $data);
        file_put_contents(base_path("/routes/api_generated.php"), $content);
        $this->call('optimize');
    }
}
