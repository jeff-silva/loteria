<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::firstOrNew(['id' => 1], [
            'name' => 'User Root',
            'email' => 'root@grr.la',
            'password' => '321321',
        ]);
        
        $user->save();
    }
}
