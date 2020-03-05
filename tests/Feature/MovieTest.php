<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MovieTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('GET', ('movies.index');

        $response->assertStatus(200);
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
    create movie
        Index (ADD A MOVIE / Query has min_lenght / Query has max_lenght / query has key_Word / Query rating / load movie + reviews)
        Load reviews ONLY IF USER(with a review for a specific movie / without a review)
        ShowActors (actors in a specific movie movie/actor)
        Update ONLY IF ADMIN(edit title / edit director / edit actors / edit runtime / edit genre / not admin try to modify = ERROR)
        Destroy  ONLY IF ADMIN(Remove a movie)
       
    Research movie
         Mots-clés (dans title et description)
         Classification (rating)
         Durée minimale
         Durée maximale
    */
}
