<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Transit;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\City;

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
// $table->bigInteger('from');
// $table->bigInteger('to');
// $table->timestamps();

$factory->define(Transit::class, function (Faker $faker) {
    
    $city_1 = City::all()->random(1)->first()->id;
    $city_2 = City::all()->random(1)->first()->id;
    
    return [
        'name' => $faker->name,
        'from' => $city_1,
        'to' => $city_2
    ];
});
