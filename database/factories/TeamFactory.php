<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Team;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\Trip;

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
// $table->bigInteger('trip_id');
// $table->string('name');
// $table->string('color')->nullable();
// $table->string('badge')->nullable();
// $table->bigInteger('score');
// $table->timestamps();

$factory->define(Team::class, function (Faker $faker) {

    $trip_id = Trip::all()->random(1)->first()->id;

    return [

        'trip_id' => $trip_id,
        'name' => $faker->name,
        'color' => $faker->hexcolor,
        'badge' => $faker->imageUrl($width = 640, $height = 640),
        'score' => $faker->numberBetween($min = 10000, $max = 9000000)
    ];
});
