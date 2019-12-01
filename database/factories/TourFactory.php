<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Tour;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
// $table->string('name');
// $table->float('duration');
// $table->timestamps();

$factory->define(Tour::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'duration' => $faker->randomFloat($nbMaxDecimals = 2, $min = 240, $max = 720)
    ];
});
