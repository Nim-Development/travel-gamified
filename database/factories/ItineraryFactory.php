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
    return [
        'tour_id' => 1,
        'step' => 1,
        'duration' => $faker->randomFloat($nbMaxDecimals = 2, $min = 24, $max = 72),
        'playfield_type' => 'city',
        'playfield_id' => 1
    ];
});
