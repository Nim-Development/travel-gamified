<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Validate\ValidateHelper;

class ValidateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('validatehelper',function(){
            return new ValidateHelper();
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
