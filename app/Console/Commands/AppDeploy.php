<?php

namespace App\Console\Commands;

class AppDeploy extends AppBase
{
    protected $signature = 'app:deploy';
    protected $description = 'Utilize este comando no servidor para deploy da aplicação';

    public function handle()
    {   
        $this->call('optimize:clear');
        $this->call('app:db-import');
        $this->call('migrate');
        $this->call('db:seed');
        $this->call('optimize:clear');
    }
}
