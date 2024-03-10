<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        config([
            'settings' => \App\GlobalModel::all([
                'name', 'status'
            ])
                ->keyBy('name') // key every setting by its name
                ->transform(function ($setting) {
                    return $setting->status;// return only the value
                })
                ->toArray() // make it an array
        ]);
    }
}
