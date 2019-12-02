<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\GameMultipleChoiceOption;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\GameMultipleChoice;

// $table->bigIncrements('id');
// $table->bigInteger('game_id');
// $table->integer('sort_order');
// $table->string('text');
// $table->timestamps();

$factory->define(GameMultipleChoiceOption::class, function (Faker $faker) {
    $game = GameMultipleChoice::all()->random(1)->first();
    return [
        'game_id' => $game->id, // Change manually (only 1 per game)
        'sort_order' => 1, // cant fake this.
        'text' => $faker->sentence($nbWords = 6, $variableNbWords = true)
    ];
});
