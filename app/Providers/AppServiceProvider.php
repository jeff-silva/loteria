<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Bugfix: SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);

        if (! \Schema::hasTable('settings')) return;
        
        // $settings = \Cache::remember('settings', 60*60, function() {
        //     return \App\Models\Settings::select(['name', 'value'])->get()->pluck('value', 'name')->toArray();
        // });

        $settings = \App\Models\Settings::select(['name', 'value'])->get()->pluck('value', 'name')->toArray();
        config($settings);
    }
}
