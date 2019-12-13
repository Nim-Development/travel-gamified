<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TripControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    // public function non_authenticated_user_can_not_access_trip_api_endpoints()
    // {
    //     $this->json('GET', '/api/trips')->assertStatus(401);
    //     $this->json('GET', 'api/trips/1')->assertStatus(401);
    //     $this->json('PUT', 'api/trips/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/trips/1')->assertStatus(401);
    //     $this->json('POST', '/api/trips')->assertStatus(401);
    // }

    /**
     * @test
     */
    public function will_fail_with_a_404_if_trip_is_not_found()
    {
        $res = $this->json('GET', 'api/trips/-1');
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_trip_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/trips/-1');
    //     $res->assertStatus(404);
    // }

        /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_trip_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/trips/-1');
    //     $res->assertStatus(404);
    // }

    /**
     * A basic feature test example.
     * // @test << ::nk Makes it so that we dont have to add test prefix infront of each method!!
     *
     * @test
     *
     */
    // public function can_create_a_trip()
    // {

    //     $faker = Factory::create();

    //     $trip_data = [

    //     ];

    //     $res = $this->json('POST', '/api/trips', $trip_data);

    //     // Then
    //         // Describes the outcome of Action according to conditions in Given

    //     $res->assertJsonStructure([])
    //         ->assertJson($trip_data)
    //         ->assertStatus(201);

    //     // assert if the trip has been added to the database
    //     $this->assertDatabaseHas('trips', $trip_data);

    // }

    /**
     * @test
     */
    // public function can_update_a_trip()
    // {
    //     // Given
    //     $old_trip = $this->create('Trip');

    //     $new_trip = [
    //         'name' => $old_trip->name.'_update',
    //         'slug' => $old_trip->slug.'_update',
    //         'price' => $old_trip->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/trips/'.$old_trip->id,
    //                             $new_trip);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_trip);
    //     $this->assertDatabaseHas('trips', $new_trip);

    // }

    /**
     * @test
     */
    // public function can_delete_a_trip()
    // {
    //     // Given
    //     // first create a trip in the database to delete
    //     $trip = $this->create('Trip');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/trips/'.$trip->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $trip is deleted from database
    //     $this->assertDatabaseMissing('trips', ['id' => $trip->id]);
    // }

    /**
     * @test
     */
    public function can_return_a_trip()
    {
        // Given
        $tour = $this->create('Tour');
        $trip = $this->create('Trip', ['tour_id' => $tour->id]);

        // When
        $response = $this->json('GET', '/api/trips/'.$trip->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                    'id' => $trip->id,
                    'name' => $trip->name,
                    'timezone' => $trip->slug,
                    'start_date_time' => $trip->price,
                    'tour' => [
                        'id' => $tour->id,
                        'name' => $tour->name,
                        'duration' => $tour->duration,
                        'created_at' => (string)$tour->created_at
                    ],
                    'created_at' => (string)$trip->created_at
                    // 'updated_at' => (string)$trip->updated_at
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_all_trips()
    {

        $tour = $this->create('Tour');

        $trip_1 = $this->create('Trip', ['tour_id' => $tour->id]);
        $trip_2 = $this->create('Trip', ['tour_id' => $tour->id]);
        $trip_3 = $this->create('Trip', ['tour_id' => $tour->id]);
        $trip_4 = $this->create('Trip', ['tour_id' => $tour->id]);
        $trip_5 = $this->create('Trip', ['tour_id' => $tour->id]);
        $trip_6 = $this->create('Trip', ['tour_id' => $tour->id]);

        $response = $this->json('GET', '/api/trips');

        $response->assertStatus(200)
                ->assertJsonCount(6, 'data.*')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'timezone',
                            'start_date_time',
                            'tour' => [
                                'id',
                                'name',
                                'duration',
                                'created_at'
                            ],
                            'created_at'
                        ]
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_paginated_trips()
    {

        $tour = $this->create('Tour');

        $trip_1 = $this->create('Trip', ['tour_id' => $tour->id]);
        $trip_2 = $this->create('Trip', ['tour_id' => $tour->id]);
        $trip_3 = $this->create('Trip', ['tour_id' => $tour->id]);
        $trip_4 = $this->create('Trip', ['tour_id' => $tour->id]);
        $trip_5 = $this->create('Trip', ['tour_id' => $tour->id]);
        $trip_6 = $this->create('Trip', ['tour_id' => $tour->id]);

        $response = $this->json('GET', '/api/trips/paginate/3');

        $response->assertStatus(200)
                ->assertJsonCount(3, 'data.*')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'timezone',
                            'start_date_time',
                            'tour' => [
                                'id',
                                'name',
                                'duration',
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
