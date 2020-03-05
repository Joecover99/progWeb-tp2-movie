<?php

namespace Tests\Feature;

use App\Movie;
use App\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    /**
     * Undocumented function
     *
     * @test
     * @return void
     */
    public function guessCanAccessAMoviesReview()
    {
        // Arrange
        $movie = factory(Movie::class)->create();
        $review = factory(Review::class)->raw();
        $movie->createReview($review);

        // Act
        $response = $this->json('GET', "/api/movies/{$movie->id}/reviews");

        // Assert
        $response->assertSuccessful()
            ->assertJson($review);
    }
    
}
