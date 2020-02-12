<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Itinerary;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\Tour;
use App\City;
use App\Transit;

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
        'tour_id' => NULL,
        'step' => 1,
        'duration' => $faker->numberBetween($nbMaxDecimals = 2, $min = 10000, $max = 43200),
        'playfield_type' => 'city',
        'playfield_id' => NULL
    ];
});
