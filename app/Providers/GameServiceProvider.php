<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Helpers\Game\GameHelper;

class GameServiceProvider extends ServiceProvider
{

    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind('gamehelper',function(){
            return new GameHelper();
        });
    }
}
