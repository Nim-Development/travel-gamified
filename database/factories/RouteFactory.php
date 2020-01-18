<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Route;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
// $table->bigInteger('transit_id');
// $table->string('name');
// $table->text('maps_url');
// $table->float('kilometers');
// $table->float('hours');

// $table->integer('difficulty');
// $table->integer('nature');
// $table->integer('highway');
// $table->timestamps();


$factory->define(Route::class, function (Faker $faker) {
    return [
        'transit_id' => NULL,
        'name' => $faker->name,
        'maps_url' => $faker->url,
        'kilometers' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 300),
        'hours' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 13),
        'difficulty' => $faker->numberBetween($min = 0, $max = 100),
        'nature' => $faker->numberBetween($min = 0, $max = 100),
        'highway' => $faker->numberBetween($min = 0, $max = 100)
    ];
});
