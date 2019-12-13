<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteControllerTest extends TestCase
{

    use RefreshDatabase;

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
    public function will_fail_with_a_404_if_route_is_not_found()
    {
        $res = $this->json('GET', 'api/routes/-1');
        $res->assertStatus(404);
    }

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
    //     $this->assertDatabaseHas('routes', $route_data);

    // }

    /**
     * @test
     */
    // public function can_update_a_route()
    // {
    //     // Given
    //     $old_route = $this->create('Route');

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
    //     $this->assertDatabaseHas('routes', $new_route);

    // }

    /**
     * @test
     */
    // public function can_delete_a_route()
    // {
    //     // Given
    //     // first create a route in the database to delete
    //     $route = $this->create('Route');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/routes/'.$route->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $route is deleted from database
    //     $this->assertDatabaseMissing('routes', ['id' => $route->id]);
    // }

    /**
     * @test
     */
    public function can_return_a_route()
    {
        // Given
        $transit = $this->create('Transit');

        $route = $this->create('Route', ['transit_id' => $transit->id]);

        // When
        $response = $this->json('GET', '/api/routes/'.$route->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                    'id' => $route->id,
                    'name' => $route->name,
                    'maps_url' => $route->maps_url,
                    'kilometers' => $route->kilometers,
                    'hours' => $route->hours,
                    'difficulty' => $route->difficulty,
                    'nature' => $route->nature,
                    'highway' => $route->nature,
                    'transit' => [
                        'id' => $transit->id,
                        'name' => $transit->name,
                        'from' => $transit->from,
                        'to' => $transit->to,
                        'created_at' => (string)$transit->created_at
                    ],
                    'created_at' => (string)$route->created_at,
                    // 'updated_at' => (string)$route->updated_at
                ]);

    }

    /**
     * @test
     */
    public function can_return_a_collection_of_all_routes()
    {
        $transit = $this->create('Transit');

        $route_1 = $this->create('Route', ['transit_id' => $transit->id]);
        $route_2 = $this->create('Route', ['transit_id' => $transit->id]);
        $route_3 = $this->create('Route', ['transit_id' => $transit->id]);
        $route_4 = $this->create('Route', ['transit_id' => $transit->id]);
        $route_5 = $this->create('Route', ['transit_id' => $transit->id]);
        $route_6 = $this->create('Route', ['transit_id' => $transit->id]);

        $response = $this->json('GET', "/api/routes");

        $response->assertStatus(200)
                ->assertJsonCount(6, 'data.*')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections
                            'id',
                            'name',
                            'maps_url',
                            'kilometers',
                            'hours',
                            'difficulty',
                            'nature',
                            'highway',
                            'transit' => [
                                'id',
                                'name',
                                'from',
                                'to',
                                'created_at'
                            ],
                            'created_at'
                        ]
                    ],
                    // Check if it is paginated
                    'links' => ['first', 'last', 'prev', 'next'],
                    'meta' => [
                        'current_page', 'last_page', 'from', 'to',
                        'path', 'per_page', 'total'
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_paginated_routes()
    {
        $transit = $this->create('Transit');

        $route_1 = $this->create('Route', ['transit_id' => $transit->id]);
        $route_2 = $this->create('Route', ['transit_id' => $transit->id]);
        $route_3 = $this->create('Route', ['transit_id' => $transit->id]);
        $route_4 = $this->create('Route', ['transit_id' => $transit->id]);
        $route_5 = $this->create('Route', ['transit_id' => $transit->id]);
        $route_6 = $this->create('Route', ['transit_id' => $transit->id]);

        $response = $this->json('GET', "/api/routes/paginate/3");

        $response->assertStatus(200)
                ->assertJsonCount(3, 'data.*')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections
                            'id',
                            'name',
                            'maps_url',
                            'kilometers',
                            'hours',
                            'difficulty',
                            'nature',
                            'highway',
                            'transit' => [
                                'id',
                                'name',
                                'from',
                                'to',
                                'created_at'
                            ],
                            'created_at'
                        ]
                    ],
                    // Check if it is paginated
                    'links' => ['first', 'last', 'prev', 'next'],
                    'meta' => [
                        'current_page', 'last_page', 'from', 'to',
                        'path', 'per_page', 'total'
                    ]
                ]);
    }
}
