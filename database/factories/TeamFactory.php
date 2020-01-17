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
// $table->bigInteger('score');
// $table->timestamps();

$factory->define(Team::class, function (Faker $faker) {
    return [

        'trip_id' => NULL,
        'name' => $faker->name,
        'color' => $faker->hexcolor,
        'score' => $faker->numberBetween($min = 10000, $max = 9000000)
    ];
});
