<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppBuild extends Command
{
    protected $signature = 'app:build';
    protected $description = 'Publica app';

    public function handle() {
        $this->comment('⚙️  Em breve');
    }
}
