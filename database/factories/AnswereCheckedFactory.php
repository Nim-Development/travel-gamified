<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\AnswereChecked;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\Challenge;
use App\User;

// $table->bigIncrements('id');
// $table->bigInteger('challenge_id');
// $table->bigInteger('user_id');
// $table->string('answere');
// $table->bigInteger('score');
// $table->timestamps();

$factory->define(AnswereChecked::class, function (Faker $faker) {
    return [
        'challenge_id' => NULL,
        'user_id' => NULL,
        'answere' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
        'score' => $faker->numberBetween(20, 400)
    ];
});
