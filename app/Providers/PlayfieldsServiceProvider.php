<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Modules\Morph\Playfields;

class PlayfieldsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('playfields',function(){
            return new Playfields(config('morphMap.playfields'));
        });
    }

    public function boot()
    {
        //
    }
}
