<?php

namespace Tests\Feature;

use App\Language;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Tests\TestCase;

class MovieTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexReturnsAllMoviesPaginatedTest()
    {

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

    /** @test */
    public function testPostIndexStoreProvidedMovie()
    {
        $parameters = [
            'title' => 'Have it Your Way',
            'release_year' => 2018,
            'length' => 1,
            'description' => 'https://www.youtube.com/watch?v=EFtU3olKhpE',
            'language_id' => 0
        ];

        $this->post('/api/movies', $parameters)->assertStatus(201);
        $this->assertDatabaseHas('movies', $parameters);
    }

    public function testPostIndexStoreWithoutRequiredParameterResponse400()
    {
        $this->post('/api/movies')->assertStatus(400);
    }

    public function testBasicExample()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', '/user', ['name' => 'Sally']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
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