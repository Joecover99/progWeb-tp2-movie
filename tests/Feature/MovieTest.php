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
}
