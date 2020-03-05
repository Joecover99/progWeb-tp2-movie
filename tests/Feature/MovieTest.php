<?php

namespace Tests\Feature;

use App\Language;
use App\Movie;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Tests\TestCase;

class MovieFeatureTest extends TestCase
{

    use RefreshDatabase;

    private $movieParameters = [
        'title' => 'Have it Your Way',
        'release_year' => 2018,
        'length' => 1,
        'description' => 'https://www.youtube.com/watch?v=EFtU3olKhpE',
        'rating' => 'G',
        'language_id' => 1,
    ];

    /// TEST: [get] /api/movies
    /**
     * description
     * 
     * @test
     * @return void
     */
    public function getIndexAsGuess_returnsAllMoviesPaginated() {

        $response = $this->json('GET', '/api/movies');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [],
                'links' => [],
                'meta' => []
            ]);
            // ->assertJsonStructure([
            //     'id', 'title', 'release_year', 'length', 'description', 'rating', 'language'
            // ])
    }

    /// TEST: [post] /api/movies
    /**
     * Undocumented function
     *
     * @test
     * @return void
     */
    public function postIndexAsAdminWithRequiredParameter_storeMovieInDatabase() {
        // Arrange
        $movieAttribute = factory(Movie::class)->raw();

        // act
        $this->actinAsAdmin()
            ->post('/api/movies', $movieAttribute)

        // assert
            ->assertStatus(201);

        $this->assertDatabaseHas('movies', $movieAttribute);
    }

    /**
     * Undocumented function
     *
     * @test
     * @return void
     */
    public function postIndexAsGuess_returnsStatus401() {
        $this->post('api/movies', $this->movieParameters)
            ->assertStatus(401);
    }

    /**
     * Undocumented function
     *
     * @test
     * @return void
     */
    public function postIndexAsUser_returnsStatus403() {
        $this->actinAsUser()
            ->post('api/movies', $this->movieParameters)
            ->assertStatus(403);
    }

    /**
     * Undocumented function
     * 
     * @test
     * @return void
     */
    public function postIndexAsAdminWithoutRequiredParameter_returnsStatus400() {
        $this->actinAsAdmin()
            ->post('/api/movies')
            ->assertStatus(400);
    }

    /// TEST: [get] /api/movies/{id}/actors
    /**
     * Undocumented function
     *
     * @test
     * @return void
     */
    public function aGuessCanRetrieveAMoviesActors() {
        $movieId = 1;
        $this->jsonGet("/api/movies/{$movieId}/actors")
            ->assertSuccessful();
    }

    /*
    create 
    rating enum
    specialFeature
    fillable
    language
    reviews
    actors
    hasActors
    addActor
    Authentification

    MOVIE
        Load reviews ONLY IF USER(with a review / without a review)
        ShowActors (actors in a specific movie movie/actor)
        Update ONLY IF ADMIN(edit title / edit director / edit actors / edit runtime / edit genre / not admin try to modify = ERROR)
        Destroy  ONLY IF ADMIN(Remove a movie)

    */
}
