<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Critic;
use App\Movie;
use App\User;
use Faker\Generator as Faker;

$factory->define(Critic::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'movie_id' => Movie::all()->random()->id,
        'score' => $faker->numerify('##.#'),
        'comment' => $faker->sentence()
    ];
});
