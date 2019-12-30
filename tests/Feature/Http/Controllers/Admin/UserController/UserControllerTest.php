<?php

namespace Tests\Feature\Http\Controllers\Admin\UserController;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{

    use RefreshDatabase;
    // Include the different tests (seperated by API type)
    use Get;
    use Post;
    use Put;
    use Delete;
    /**
     * @test
     */
    // public function non_authenticated_user_can_not_access_user_api_endpoints()
    // {
    //     $this->json('GET', '/api/users')->assertStatus(401);
    //     $this->json('GET', 'api/users/1')->assertStatus(401);
    //     $this->json('PUT', 'api/users/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/users/1')->assertStatus(401);
    //     $this->json('POST', '/api/users')->assertStatus(401);
    // }

    /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_user_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/users/-1');
    //     $res->assertStatus(404);
    // }

        /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_user_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/users/-1');
    //     $res->assertStatus(404);
    // }

    /**
     * A basic feature test example.
     * // @test << ::nk Makes it so that we dont have to add test prefix infront of each method!!
     *
     * @test
     *
     */
    // public function can_create_a_user()
    // {

    //     $faker = Factory::create();

    //     $user_data = [

    //     ];

    //     $res = $this->json('POST', '/api/users', $user_data);

    //     // Then
    //         // Describes the outcome of Action according to conditions in Given

    //     $res->assertJsonStructure([])
    //         ->assertJson($user_data)
    //         ->assertStatus(201);

    //     // assert if the user has been added to the database
    //     $this->assertDatabaseHas('users', $user_data);

    // }

    /**
     * @test
     */
    // public function can_update_a_user()
    // {
    //     // Given
    //     $old_user = $this->create('User');

    //     $new_user = [
    //         'name' => $old_user->name.'_update',
    //         'slug' => $old_user->slug.'_update',
    //         'price' => $old_user->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/users/'.$old_user->id,
    //                             $new_user);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_user);
    //     $this->assertDatabaseHas('users', $new_user);

    // }

    /**
     * @test
     */
    // public function can_delete_a_user()
    // {
    //     // Given
    //     // first create a user in the database to delete
    //     $user = $this->create('User');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/users/'.$user->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $user is deleted from database
    //     $this->assertDatabaseMissing('users', ['id' => $user->id]);
    // }

}
