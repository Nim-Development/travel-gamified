<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\GameMediaUpload;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

// $table->bigIncrements('id');
// $table->string('title');
// $table->string('content_media');
// $table->string('content_text');
// $table->string('media_type');
// $table->bigInteger('correct_answere');
// $table->bigInteger('points_min');
// $table->bigInteger('points_max');
// $table->timestamps();

$factory->define(GameMediaUpload::class, function (Faker $faker) {    
    return [
        'title' => $faker->name,
        'content_media' => $faker->imageUrl($width = 640, $height = 640), // cant fake this.
        'content_text' => $faker->sentence($nbWords = 32, $variableNbWords = true),
        'media_type' => 'image', // could also be audio or video
        'correct_answere' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'points_min' => 0,
        'points_max' => 35000
    ];
});
