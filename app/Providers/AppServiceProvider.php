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
        if (! \Schema::hasTable('settings')) return;
        
        // $settings = \Cache::remember('settings', 60*60, function() {
        //     return \App\Models\Settings::select(['name', 'value'])->get()->pluck('value', 'name')->toArray();
        // });

        $settings = \App\Models\Settings::select(['name', 'value'])->get()->pluck('value', 'name')->toArray();
        config($settings);
    }
}
