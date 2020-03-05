<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Laravel 5')
             ->dontSee('Rails');
    }
}
/*
 Consultation des informations d’un certain user (seulement si on est connecté avec ce user) / if user not connected ERROR
 Ajout d’un nouveau user 
 Modification d’un user existant (seulement si on est connecté avec ce user) / if user not connected ERROR
*/