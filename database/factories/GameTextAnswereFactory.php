<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\GameTextAnswere;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

// $table->bigIncrements('id');
// $table->string('title');
// $table->string('content_text');
// $table->bigInteger('correct_answere');
// $table->bigInteger('points_min');
// $table->bigInteger('points_max');
// $table->timestamps();

$factory->define(GameTextAnswere::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'content_text' => $faker->sentence($nbWords = 32, $variableNbWords = true),
        'correct_answere' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'points_min' => 0,
        'points_max' => 35000
    ];
});
