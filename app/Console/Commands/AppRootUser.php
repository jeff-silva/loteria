<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppRootUser extends Command
{
    protected $signature = 'app:root-user';
    protected $description = 'Gera/reseta usuário root';

    public function handle()
    {
        if ($user = \App\Models\User::find(1)) {
            $password = '321321';
            $user->password = \Hash::make($password);
            $user->save();
            $this->comment("E-mail: {$user->email}");
            $this->comment("Password: {$password}");
            return;
        }
        
        $this->comment('User id=1 not found');
    }
}
