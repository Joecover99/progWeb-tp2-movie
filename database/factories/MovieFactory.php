<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Movie;
use App\Language;
use Faker\Generator as Faker;

$factory->define(Movie::class, function (Faker $faker) {
    $releaseDate = $faker->date();
    return [
        'title' = "Captain AIDS ({$releaseDate})",
        'description' = $faker->paragraph(),
        'release_year' = $releaseDate,
        `language_id` = Language::all()->random()->first()->id,
        `length` = $faker->randomNumber(3),
        `rating` = array_rand(Movie::ratingEnum),
        `special_features` = array_rand(Movie::specialFeatures)
    ];
});
