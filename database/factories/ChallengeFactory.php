<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Games\Challenge;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\Playfields\Route;
use App\Playfields\City;
use App\Games\GameTextAnswere;

$factory->define(Challenge::class, function (Faker $faker) {
    return [
        'sort_order' => 1,
        'playfield_type' => 'city',
        'playfield_id' => NULL,
        'game_type' => 'media_upload',
        'game_id' => NULL,
    ];
});
