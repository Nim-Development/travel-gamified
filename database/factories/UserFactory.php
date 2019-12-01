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

// $table->bigIncrements('id');
// $table->bigInteger('team_id');
// $table->bigInteger('trip_id');

// $table->string('email')->unique();
// $table->string('phone');
// $table->timestamp('email_verified_at')->nullable();
// $table->string('password');

// $table->string('first_name');
// $table->string('family_name');
// $table->integer('age');
// $table->string('gender');
// $table->bigInteger('score');

// $table->rememberToken();
// $table->timestamps();

$factory->define(User::class, function (Faker $faker) {

    $team_1 = Team::all()->random(1)->first();
    $genders = ['male', 'female'];
    $gender = $genders[random_int(0,1)];

    return [
        'team_id' => $team_1->id,
        'trip_id' => $team_1->trip_id,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->e164PhoneNumber,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'first_name' => $faker->firstName($gender = $gender),
        'family_name' => $faker->lastName,
        'age' => $faker->numberBetween($min = 16, $max = 40),
        'gender' => $gender,
        'score' => $faker->numberBetween($min = 5000, $max = 4500000),
        'remember_token' => Str::random(10)
    ];
});
