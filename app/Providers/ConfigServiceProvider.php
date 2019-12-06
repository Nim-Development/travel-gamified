<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Config\ConfigHelper;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('confighelper',function(){
            return new ConfigHelper();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
