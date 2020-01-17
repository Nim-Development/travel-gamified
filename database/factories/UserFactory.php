<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\Team;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'team_id' => null,
        'trip_id' => null,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->e164PhoneNumber,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'first_name' => $faker->firstName(),
        'family_name' => $faker->lastName,
        'age' => $faker->numberBetween($min = 16, $max = 40),
        'gender' => 'male',
        'score' => $faker->numberBetween($min = 5000, $max = 4500000),
        'remember_token' => Str::random(10)
    ];
});
