<?php

namespace Tests\Unit;

use App\Actor;
use App\Movie;
use PHPUnit\Framework\TestCase;

class MovieUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @test
     * @return void
     */
    public function hasActor_WHEN_actorBelongsToMovie_RETURNS_true() {
        // Arrange
        /** @var Movie */
        $movie = factory(Movie::class)->create();
        /** @var Actor */
        $actor = factory(Actor::class)->create();
        $movie->addActor($actor);

        // Act
        $returnedValue = $movie->hasActor($actor);

        // Assert
        assertTrue($returnedValue);
    }

    /**
     * A basic unit test example.
     *
     * @test
     * @return void
     */
    public function addActor_addActorsToMovie() {
        // Arrange
        /** @var Movie */
        $movie = factory(Movie::class)->create();
        /** @var Actor */
        $actor = factory(Actor::class)->create();

        // Act
        $movie->addActor($actor);

        // Assert
        $returnedValue = $movie->hasActor($actor);
        assertTrue($returnedValue);
    }

    /**
     * A basic unit test example.
     *
     * @test
     * @return void
     */
    public function hasActor_WHEN_actorDoesntbelongsToMovie_RETURNS_true() {
        // Arrange
        /** @var Movie */
        $movie = factory(Movie::class)->create();
        /** @var Actor */
        $actor = factory(Actor::class)->create();

        // Act
        $returnedValue = $movie->hasActor($actor);

        // Assert
        assertFalse($returnedValue);
    }


    // language
    // reviews
    // createReview
    // actors
    // hasActor
    // addActor
}
