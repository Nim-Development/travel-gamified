<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Itinerary;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\Tour;
use App\Playfields\City;
use App\Playfields\Transit;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

// $table->bigIncrements('id');
// $table->bigInteger('tour_id');
// $table->integer('step');
// $table->float('duration');
// $table->bigInteger('city_id')->nullable();
// $table->bigInteger('transit_id')->nullable();
// $table->timestamps();

$factory->define(Itinerary::class, function (Faker $faker) {

    $tour_id = Tour::all()->random(1)->first()->id;
    $city_id = City::all()->random(1)->first()->id;
    $transit_id = Transit::all()->random(1)->first()->id;

    $city_or_transit = (bool)random_int(0, 1);

    return [
        'tour_id' => $tour_id,
        'step' => 1, // cant fake this.
        'duration' => $faker->randomFloat($nbMaxDecimals = 2, $min = 24, $max = 72),
        'city_id' => $city_or_transit ? NULL : $city_id,
        'transit_id' => $city_or_transit ? $transit_id : NULL
    ];
});
