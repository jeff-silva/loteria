<?php

namespace App\Console\Commands;

class AppDev extends AppBase
{
    protected $signature = 'app:dev';
    protected $description = 'Utilize este comando sempre que alterar algo no banco de dados ou nos arquivos em app/Formats';

    public function handle()
    {   
        $this->call('optimize');
        $this->call('app:db-export');
        $this->call('optimize');
        $this->call('app:make-models');
        $this->call('app:make-controllers');
        $this->call('app:make-routes');
        $this->call('app:make-env');
        $this->call('optimize');
    }
}
