<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Games\Challenge;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\Playfields\Route;
use App\Playfields\City;
use App\Games\GameTextAnswere;

// $table->bigIncrements('id');
// $table->bigInteger('city_id')->nullable();
// $table->bigInteger('route_id')->nullable();
// $table->string('game_model');
// $table->bigInteger('game_id');
// $table->timestamps();

$factory->define(Challenge::class, function (Faker $faker) {

    $city = City::all()->random(1)->first();
    $route = Route::all()->random(1)->first();
    $game = GameTextAnswere::all()->random(1)->first();

    $city_or_route = (bool)random_int(0, 1);

    return [
        'city_id' => $city_or_route ? $city->id : NULL,
        'route_id' => $city_or_route ? NULL : $route->id,
        'game_model' => 'GameTextAnswere', // Change manually
        'game_id' => $game->id, // Change manually
    ];
});
