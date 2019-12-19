<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Trip;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\Tour;

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
// $table->string('name');
// $table->string('timezone');
// $table->dateTime('start_date_time')->nullable();
// $table->bigInteger('score');

// $table->timestamps();

$factory->define(Trip::class, function (Faker $faker) {
    return [
        'tour_id' => 1,
        'name' => $faker->name,
        'timezone' => 'GMT+7',
        'start_date_time' => $faker->dateTime($max = NULL, $timezone = NULL),
        'score' => $faker->numberBetween($min = 3000000, $max = 12000000)
    ];
});
