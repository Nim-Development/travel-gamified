<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\PasswordReset;

$factory->define(PasswordReset::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'token' => strtoupper(\Str::random(6))
    ];
});
