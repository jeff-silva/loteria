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
        $user = \App\Models\User::firstOrCreate(['id' => 1], [
            'name' => 'Root',
            'email' => 'root@grr.la',
            'email_verified_at' => now(),
            'password' => \Hash::make('321321'),
        ]);
    }
}
