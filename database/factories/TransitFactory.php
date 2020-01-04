<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Playfields\Transit;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\Playfields\City;

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
    return [
        'name' => $faker->name,
        'from_city_id' => 1,
        'to_city_id' => 2
    ];
});
