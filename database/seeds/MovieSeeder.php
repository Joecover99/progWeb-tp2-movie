<?php

use Illuminate\Database\Seeder;
use App\Movie;
use App\Actor;
use App\Review;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Movie::class, 100)
            ->create()
            ->each(function (Movie $movie) {
                $actorCount = rand(1, 6);
                for ($i=0; $i < $actorCount; $i++) { 
                    $randomActor = Actor::all()->random();
                    $movie->addActor($randomActor);
                }

                $reviewCount = rand(0, 2);
                for ($i=0; $i < $actorCount; $i++) { 
                    $review = factory(Review::class)->make();
                    $movie->createReview($review->attributesToArray());
                }
            });
    }
}
