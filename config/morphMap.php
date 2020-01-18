<?php

return [
    /*
    |--------------------------------------------------------------------------
    | USED IN MorphServiceProvider AND IN Modules\Game, Modules\Playfield
    |--------------------------------------------------------------------------
    |
    | Maps the polymorphic models to more readable string identifiers.
    |
    */
    'games' => [
        'media_upload' => \App\GameMediaUpload::class,
        'multiple_choice' => \App\GameMultipleChoice::class,
        'text_answere' => \App\GameTextAnswere::class,
    ],
    'playfields' => [
        'city' => \App\City::class,
        'route' => \App\Route::class,
        'transit' => \App\Transit::class,
    ]
];