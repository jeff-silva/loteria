<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppBuild extends Command
{
    protected $signature = 'app:build';
    protected $description = 'Publica app';

    public function handle() {
        $this->call('migrate');
        $this->call('db:seed');
        $this->call('optimize');
        $this->call('app:db-import');
    }
}
