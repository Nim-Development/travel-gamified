<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class MorphServiceProvider extends ServiceProvider
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
        Relation::morphMap([
            'media_upload' => \App\Games\GameMediaUpload::class,
            'multiple_choice' => \App\Games\GameMultipleChoice::class,
            'text_answere' => \App\Games\GameTextAnswere::class,
            'city' => \App\Playfields\City::class,
            'route' => \App\Playfields\Route::class,
            'transit' => \App\Playfields\Transit::class,
          ]);
    }
}
