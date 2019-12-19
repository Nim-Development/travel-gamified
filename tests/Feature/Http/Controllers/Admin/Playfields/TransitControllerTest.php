<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransitControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    // public function non_authenticated_user_can_not_access_transit_api_endpoints()
    // {
    //     $this->json('GET', '/api/transits')->assertStatus(401);
    //     $this->json('GET', 'api/transits/1')->assertStatus(401);
    //     $this->json('PUT', 'api/transits/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/transits/1')->assertStatus(401);
    //     $this->json('POST', '/api/transits')->assertStatus(401);
    // }

    /**
     * @test
     */
    public function will_fail_with_a_404_if_transit_is_not_found()
    {
        $res = $this->json('GET', 'api/transits/-1');
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_transit_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/transits/-1');
    //     $res->assertStatus(404);
    // }

        /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_transit_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/transits/-1');
    //     $res->assertStatus(404);
    // }

    /**
     * A basic feature test example.
     * // @test << ::nk Makes it so that we dont have to add test prefix infront of each method!!
     *
     * @test
     *
     */
    // public function can_create_a_transit()
    // {

    //     $faker = Factory::create();

    //     $transit_data = [

    //     ];

    //     $res = $this->json('POST', '/api/transits', $transit_data);

    //     // Then
    //         // Describes the outcome of Action according to conditions in Given

    //     $res->assertJsonStructure([])
    //         ->assertJson($transit_data)
    //         ->assertStatus(201);

    //     // assert if the transit has been added to the database
    //     $this->assertDatabaseHas('transits', $transit_data);

    // }

    /**
     * @test
     */
    // public function can_update_a_transit()
    // {
    //     // Given
    //     $old_transit = $this->create('Transit');

    //     $new_transit = [
    //         'name' => $old_transit->name.'_update',
    //         'slug' => $old_transit->slug.'_update',
    //         'price' => $old_transit->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/transits/'.$old_transit->id,
    //                             $new_transit);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_transit);
    //     $this->assertDatabaseHas('transits', $new_transit);

    // }

    /**
     * @test
     */
    // public function can_delete_a_transit()
    // {
    //     // Given
    //     // first create a transit in the database to delete
    //     $transit = $this->create('Transit');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/transits/'.$transit->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $transit is deleted from database
    //     $this->assertDatabaseMissing('transits', ['id' => $transit->id]);
    // }

    /**
     * @test
     */
    public function can_return_a_transit()
    {
        // Given
        // inserting a model into the database (we know this will work because test can_create_a_transit() was asserted succesfully)
        $transit = $this->create('Transit');

        // When
        $response = $this->json('GET', '/api/transits/'.$transit->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                    'id' => $transit->id,
                    'name' => $transit->name,
                    'from' => $transit->from,
                    'to' => $transit->to,
                    'created_at' => (string)$transit->created_at,
                    // 'updated_at' => (string)$transit->updated_at
                ]);

    }


    /**
     * @test
     */
    public function can_return_a_collection_of_all_transits()
    {
        $transit_1 = $this->create('Transit');
        $transit_2 = $this->create('Transit');
        $transit_3 = $this->create('Transit');

        $response = $this->json('GET', '/api/transits');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections
                            'name', 'from', 'to'
                        ]
                    ],
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_paginated_transits()
    {
        $transit_1 = $this->create('Transit');
        $transit_2 = $this->create('Transit');
        $transit_3 = $this->create('Transit');
        $transit_4 = $this->create('Transit');
        $transit_5 = $this->create('Transit');
        $transit_6 = $this->create('Transit');

        $response = $this->json('GET', '/api/transits/paginate/3');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections
                            'name', 'from', 'to'
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
