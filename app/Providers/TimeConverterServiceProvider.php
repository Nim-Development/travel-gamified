<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Time\TimeConverter;

class TimeConverterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('converter',function(){
            return new TimeConverter();
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
