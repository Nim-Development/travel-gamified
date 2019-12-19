<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\AnswereUnchecked;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\Games\Challenge;
use App\User;

// $table->bigIncrements('id');
// $table->bigInteger('challenge_id');
// $table->bigInteger('user_id');
// $table->string('answere');
// $table->bigInteger('score')->nullable();
// $table->timestamps();

$factory->define(AnswereUnchecked::class, function (Faker $faker) {
    return [
        'challenge_id' => 1,
        'user_id' => 1,
        'answere' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
        'score' => null
    ];
});
