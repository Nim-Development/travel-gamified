<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\AnswereChecked;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\Games\Challenge;
use App\User;

// $table->bigIncrements('id');
// $table->bigInteger('challenge_id');
// $table->bigInteger('user_id');
// $table->string('answere');
// $table->bigInteger('score');
// $table->timestamps();

$factory->define(AnswereChecked::class, function (Faker $faker) {

    $challenge = Challenge::all()->random(1)->first();
    $user = User::all()->random(1)->first();

    return [
        'challenge_id' => $challenge->id,
        'user_id' => $user->id,
        'answere' => $challenge->game_model == "GameMediaUpload" ? $faker->imageUrl($width = 640, $height = 640) : $faker->sentence($nbWords = 6, $variableNbWords = true),
        'score' => $faker->numberBetween($challenge->game->points_min, $challenge->game->points_max)
    ];
});
