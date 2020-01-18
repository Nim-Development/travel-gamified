<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\City;
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
// $table->string('short_code');
// $table->string('name');
// $table->timestamps();


$factory->define(City::class, function (Faker $faker) {
    return [
        'short_code' => $faker->city,
        'name' => $faker->name
    ];
});
