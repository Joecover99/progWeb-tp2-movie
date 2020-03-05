<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserFeatureTest extends TestCase {
    
    /**
     * Undocumented function
     *
     * @test
     * @return void
     */
    public function anAuthUserCanAccessItsProfile()
    {
        // Arrange
        $user = factory(User::class)->create();

        // Act
        $response = $this->actingAs($user)->get('/user');

        // Assert
        $response->assertStatus(200);
    }
  
    // public function a_default_user_is_not_an_admin()
    // {
    //     $user = factory(User::class)->create();

    //     $this->assertFalse($user->isAdmin());
    // }

    // public function an_admin_user_is_an_admin()
    // {
    //     $admin = factory(User::class)
    //         ->states('admin')
    //         ->create();

    //     $this->assertTrue($admin->isAdmin());
    // }

    public function a_default_user_cannot_access_the_admin_section()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/admin')
            ->assertStatus(403);
    }
    
    //Modification d’un user existant (seulement si on est connecté avec ce user) / if user not connected or other user ERROR
    public function a_user_can_modify_his_userProfile()
    {
        $user = factory(User::class)
            ->states('user')
            ->create();

        $this->actingAs($user)
            ->get('/user')
            ->assertStatus(200);
    }
 
    /*
    public function an_admin_can_access_the_admin_section()
    {
        $admin = factory(User::class)
            ->states('admin')
            ->create();

        $this->actingAs($admin)
            ->get('/admin')
            ->assertStatus(200);
    }*/

    /// TEST [get] /api/users/{id}
    /**
     * Undocumented function
     *
     * @test
     * @return void
     */
    public function aGuessCannotAccessTheUserPage() {
        // Arrange
        $user = factory(User::class)->create();

        // Act
        $response = $this->jsonGet("/api/users/{$user->id}");

        // Assert
        $response->assertStatus(401); // Unauthenticated
    }

    /**
     * Undocumented function
     *
     * @test
     * @return void
     */
    public function aUserCannotAccessAnotherUserPage() {
        // Arrange
        $userA = factory(User::class)->create();
        $userB = factory(User::class)->create();

        // Act
        $response = $this->actingAs($userA)->jsonGet("/api/users/{$userB->id}");

        // Assert
        $response->assertStatus(403); // Unauthenticated
    }

    /**
     * Undocumented function
     *
     * @test
     * @return void
     */
    public function aUserCanAccessItsOwnPage() {
        // Arrange
        $userA = factory(User::class)->create();

        // Act
        $response = $this->actingAs($userA)->jsonGet("/api/users/{$userA->id}");

        // Assert
        $response->dump()->assertStatus(200); // Unauthenticated
    }
}