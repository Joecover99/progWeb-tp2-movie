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

/*    public function it_allows_anyone_to_see_list_all_articles()
{
	$response = $this->get(route('get_all_articles'));
	$response->assertSuccessful();
}
public function it_allows_anyone_to_see_individual_user()
{
	$article = Article::get()->random();
	$response = $this->get(route('view_article', ['id' => $article->id]));
*/
}

 //Consultation des informations d’un certain user (seulement si on est connecté avec ce user) / if user not connected ERROR
     public function a_user_can_access_an_other_userProfile()
    {
        $user = factory(User::class)
            ->states('user')
            ->create();

        $this->actingAs($user)
            ->get('/user')
            ->assertStatus(200);
    }
  
 //Ajout d’un nouveau user 

    public function a_default_user_is_not_an_admin()
    {
        $user = factory(User::class)->create();

        $this->assertFalse($user->isAdmin());
    }

    public function an_admin_user_is_an_admin()
    {
        $admin = factory(User::class)
            ->states('admin')
            ->create();

        $this->assertTrue($admin->isAdmin());
    }

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