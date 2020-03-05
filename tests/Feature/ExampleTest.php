<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
/*
 //   use RefreshDatabase;

    /**
     * Test creating a new order.
     *
     * @return void
     
    public function testCreatingANewOrder()
    {
        // Run the DatabaseSeeder...
        $this->seed();

        // Run a single seeder...
        $this->seed(OrderStatusesTableSeeder::class);

        // ...
    }
    //$this->assertDatabaseHas($table, array $data); Assert that a table in the database contains the given data.
    //$this->assertDeleted($table, array $data); Assert that the given record has been deleted.
   /* public function testDatabase()
{
    $user = factory(App\User::class)->create();

    // Make call to application...

    $this->assertDeleted($user);
}*/
}
