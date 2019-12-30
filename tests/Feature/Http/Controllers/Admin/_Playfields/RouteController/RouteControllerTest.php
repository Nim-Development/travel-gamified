<?php

namespace Tests\Feature\Http\Controllers\Admin\Playfields\RouteController;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteControllerTest extends TestCase
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
    // public function non_authenticated_user_can_not_access_route_api_endpoints()
    // {
    //     $this->json('GET', '/api/routes')->assertStatus(401);
    //     $this->json('GET', 'api/routes/1')->assertStatus(401);
    //     $this->json('PUT', 'api/routes/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/routes/1')->assertStatus(401);
    //     $this->json('POST', '/api/routes')->assertStatus(401);
    // }

    /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_route_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/routes/-1');
    //     $res->assertStatus(404);
    // }

        /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_route_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/routes/-1');
    //     $res->assertStatus(404);
    // }

    /**
     * A basic feature test example.
     * // @test << ::nk Makes it so that we dont have to add test prefix infront of each method!!
     *
     * @test
     *
     */
    // public function can_create_a_route()
    // {

    //     $faker = Factory::create();

    //     $route_data = [

    //     ];

    //     $res = $this->json('POST', '/api/routes', $route_data);

    //     // Then
    //         // Describes the outcome of Action according to conditions in Given

    //     $res->assertJsonStructure([])
    //         ->assertJson($route_data)
    //         ->assertStatus(201);

    //     // assert if the route has been added to the database
    //     $this->assertDatabaseHas('Playfields\Routes', $route_data);

    // }

    /**
     * @test
     */
    // public function can_update_a_route()
    // {
    //     // Given
    //     $old_route = $this->create('Playfields\Route');

    //     $new_route = [
    //         'name' => $old_route->name.'_update',
    //         'slug' => $old_route->slug.'_update',
    //         'price' => $old_route->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/routes/'.$old_route->id,
    //                             $new_route);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_route);
    //     $this->assertDatabaseHas('Playfields\Routes', $new_route);

    // }

    /**
     * @test
     */
    // public function can_delete_a_route()
    // {
    //     // Given
    //     // first create a route in the database to delete
    //     $route = $this->create('Playfields\Route');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/routes/'.$route->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $route is deleted from database
    //     $this->assertDatabaseMissing('Playfields\Routes', ['id' => $route->id]);
    // }
    
}
