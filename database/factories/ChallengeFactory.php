<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Challenge;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\Route;
use App\City;
use App\GameTextAnswere;

$factory->define(Challenge::class, function (Faker $faker) {
    return [
        'sort_order' => 1,
        'playfield_type' => 'city',
        'playfield_id' => NULL,
        'game_type' => 'media_upload',
        'game_id' => NULL,
    ];
});
