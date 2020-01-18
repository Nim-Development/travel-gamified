<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Morph\Games;

class GamesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('games',function(){
            return new Games(config('morphMap.games'));
        });
    }

    public function boot()
    {
        //
    }
}
