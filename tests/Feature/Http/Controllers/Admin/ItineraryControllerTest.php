<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItineraryControllerTest extends TestCase
{

    use RefreshDatabase;


//     Route::get('itineraries', 'Admin\ItineraryController@all');
// Route::get('itineraries/{id}', 'Admin\ItineraryController@single');

    /**
     * @test
     */
    // public function non_authenticated_user_can_not_access_itinerary_api_endpoints()
    // {
    //     $this->json('GET', '/api/itineraries')->assertStatus(401);
    //     $this->json('GET', 'api/itineraries/1')->assertStatus(401);
    //     $this->json('PUT', 'api/itineraries/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/itineraries/1')->assertStatus(401);
    //     $this->json('POST', '/api/itineraries')->assertStatus(401);
    // }

    /**
     * @test
     */
    public function will_fail_with_a_404_if_itinerary_is_not_found()
    {
        $res = $this->json('GET', 'api/itineraries/-1');
        $res->assertStatus(404);
    }

        /**
     * @test
     */
    public function will_return_204_when_requesting_all_itineraries_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/itineraries');
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_itineraries_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/itineraries/paginate/3');
        $res->assertStatus(204);
    }


    /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_itinerary_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/itineraries/-1');
    //     $res->assertStatus(404);
    // }

        /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_itinerary_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/itineraries/-1');
    //     $res->assertStatus(404);
    // }

    /**
     * A basic feature test example.
     * // @test << ::nk Makes it so that we dont have to add test prefix infront of each method!!
     *
     * @test
     *
     */
    // public function can_create_a_itinerary()
    // {

    //     $faker = Factory::create();

    //     $itinerarie_data = [

    //     ];

    //     $res = $this->json('POST', '/api/itineraries', $itinerarie_data);

    //     // Then
    //         // Describes the outcome of Action according to conditions in Given

    //     $res->assertJsonStructure([])
    //         ->assertJson($itinerarie_data)
    //         ->assertStatus(201);

    //     // assert if the itinerary has been added to the database
    //     $this->assertDatabaseHas('itineraries', $itinerarie_data);

    // }

    /**
     * @test
     */
    // public function can_update_a_itinerary()
    // {
    //     // Given
    //     $old_itinerary = $this->create('Itinerary');

    //     $new_itinerary = [
    //         'name' => $old_itinerary->name.'_update',
    //         'slug' => $old_itinerary->slug.'_update',
    //         'price' => $old_itinerary->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/itineraries/'.$old_itinerary->id,
    //                             $new_itinerarie);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_itinerarie);
    //     $this->assertDatabaseHas('itineraries', $new_itinerarie);

    // }

    /**
     * @test
     */
    // public function can_delete_a_itinerary()
    // {
    //     // Given
    //     // first create a itinerary in the database to delete
    //     $itinerary = $this->create('Itinerary');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/itineraries/'.$itinerary->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $itinerary is deleted from database
    //     $this->assertDatabaseMissing('itineraries', ['id' => $itinerary->id]);
    // }

    /**
     * @test
     */
    public function returns_a_null_value_on_relationships_if_there_are_no_relationships_available()
    {
        // Given

        $itinerary = $this->create('Itinerary');

        // When
        $response = $this->json('GET', '/api/itineraries/'.$itinerary->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                    'data' => [
                        'id' => $itinerary->id,
                        'tour_id' => $itinerary->tour_id,
                        'step' => $itinerary->step,
                        'duration' => $itinerary->duration,
                        'playfield' => null,
                        'created_at' => (string)$itinerary->created_at,
                    ]
                ]
            );
    }


    /**
     * @test
     */
    public function can_return_a_itinerary_with_playfield_type_OFF_city()
    {
        // Given
        // Create playfield
        $playfield = $this->create('Playfields\City', [], false);

        $itinerary = $this->create('Itinerary', [
            'playfield_type' => 'city',
            'playfield_id' => $playfield->id
        ]);

        // When
        $response = $this->json('GET', '/api/itineraries/'.$itinerary->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                    'data' => [
                        'id' => $itinerary->id,
                        'tour_id' => $itinerary->tour_id,
                        'step' => $itinerary->step,
                        'duration' => $itinerary->duration,
                        'playfield' => [
                            'id' => $playfield->id,
                            'type' => $itinerary->playfield_type,
                            'short_code' => $playfield->short_code,
                            'name' => $playfield->name,
                            'created_at' => (string)$playfield->created_at
                        ],
                        'created_at' => (string)$itinerary->created_at,
                    ]
                ]
            );
    }

        /**
     * @test
     */
    public function can_return_a_itinerary_with_playfield_type_OFF_route()
    {
        // Given
        // Create playfield
        $playfield = $this->create('Playfields\Route', [], false);

        $itinerary = $this->create('Itinerary', [
            'playfield_type' => 'route',
            'playfield_id' => $playfield->id
        ]);

        // When
        $response = $this->json('GET', '/api/itineraries/'.$itinerary->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                    'data' => [
                        'id' => $itinerary->id,
                        'tour_id' => $itinerary->tour_id,
                        'step' => $itinerary->step,
                        'duration' => $itinerary->duration,
                        'playfield' => [
                            'id' => $playfield->id,
                            'type' => $itinerary->playfield_type,
                            'transit_id' => $playfield->transit_id,
                            'name' => $playfield->name,
                            'maps_url' => $playfield->maps_url,
                            'kilometers' => $playfield->kilometers,
                            'hours' => $playfield->hours,
                            'difficulty' => $playfield->difficulty,
                            'nature' => $playfield->nature,
                            'highway' => $playfield->highway,
                            'created_at' => (string)$playfield->created_at
                        ],
                        'created_at' => (string)$itinerary->created_at,
                    ]
                ]
            );
    }

            /**
     * @test
     */
    public function can_return_a_itinerary_with_playfield_type_OFF_transit()
    {
        // Given
        // Create playfield
        $playfield = $this->create('Playfields\Transit', [], false);

        $itinerary = $this->create('Itinerary', [
            'playfield_type' => 'transit',
            'playfield_id' => $playfield->id
        ]);

        // When
        $response = $this->json('GET', '/api/itineraries/'.$itinerary->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                    'data' => [
                        'id' => $itinerary->id,
                        'tour_id' => $itinerary->tour_id,
                        'step' => $itinerary->step,
                        'duration' => $itinerary->duration,
                        'playfield' => [
                            'id' => $playfield->id,
                            'type' => $itinerary->playfield_type,
                            'name' => $playfield->name,
                            'from' => $playfield->from,
                            'to' => $playfield->to,
                            'created_at' => (string)$playfield->created_at
                        ],
                        'created_at' => (string)$itinerary->created_at,
                    ]
                ]
            );
    }

    // Route::get('itineraries', 'Admin\ItineraryController@all');


    /**
     * @test
     */
    public function can_return_a_collection_of_all_itineraries()
    {

        $city = $this->create('Playfields\City');

        $this->create_collection('Itinerary', ['playfield_type' => 'city', 'playfield_id' => $city->id], false, 3);

        $response = $this->json('GET', "api/itineraries");

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                            'id',
                            'tour_id',
                            'step',
                            'duration',
                            'playfield' => [
                                'id',
                                'type',
                                'short_code',
                                'name',
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
    public function can_return_a_collection_of_all_itineraries_paginated()
    {

        $city = $this->create('Playfields\City');
        $this->create_collection('Itinerary', ['playfield_type' => 'city', 'playfield_id' => $city->id], false, 6);

        $response = $this->json('GET', "api/itineraries/paginate/3");
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                        '*' => [ //* to say we checking keys of multiple collections
                                'id',
                                'tour_id',
                                'step',
                                'duration',
                                'playfield' => [
                                    'id',
                                    'type',
                                    'short_code',
                                    'name',
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
    public function can_return_a_collection_of_all_itineraries_with_playfield_OFF_city()
    {
        $city = $this->create('Playfields\City');
        $this->create_collection('Itinerary', ['playfield_type' => 'city', 'playfield_id' => $city->id], false, 6);

        // create 1 more itinerary with other playfield type
        $this->create('Itinerary', ['playfield_type' => 'xxxx']);

        $response = $this->json('GET', "api/itineraries/playfield/city");
    
        // Assert if all itineraries have relation of type Transit
        $this->assert_if_all_objects_have_same_type_in_specified_relation($response, 'playfield', 'city');
        $response->assertStatus(200)
                 ->assertJsonCount(6, 'data')
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                            'id',
                            'tour_id',
                            'step',
                            'duration',
                            'playfield' => [
                                'id',
                                'type',
                                'short_code',
                                'name',
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
    public function can_return_a_collection_of_paginated_itineraries_with_playfield_OFF_city()
    {
        $city = $this->create('Playfields\City');
        $this->create_collection('Itinerary', ['playfield_type' => 'city', 'playfield_id' => $city->id], false, 6);

        // create 1 more itinerary with other playfield type
        $this->create('Itinerary', ['playfield_type' => 'xxxx']);

        $response = $this->json('GET', "api/itineraries/playfield/city/paginate/3");

        // Assert if all itineraries have relation of type Transit
        $this->assert_if_all_objects_have_same_type_in_specified_relation($response, 'playfield', 'city');
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                            'id',
                            'tour_id',
                            'step',
                            'duration',
                            'playfield' => [
                                'id',
                                'type',
                                'short_code',
                                'name',
                                'created_at'
                            ],
                            'created_at'
                         ]
                        ],
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
    public function can_return_a_collection_of_all_itineraries_with_playfield_OFF_route()
    {
        $route = $this->create('Playfields\Route');
        $this->create_collection('Itinerary', ['playfield_type' => 'route', 'playfield_id' => $route->id], false, 6);

        // create 1 more itinerary with other playfield type
        $this->create('Itinerary', ['playfield_type' => 'xxxx']);

        $response = $this->json('GET', "api/itineraries/playfield/route");

        // Assert if all itineraries have relation of type Transit
        $this->assert_if_all_objects_have_same_type_in_specified_relation($response, 'playfield', 'route');
        $response->assertStatus(200)
                 ->assertJsonCount(6, 'data')
                 ->assertJsonStructure([
                    'data' => [
                        '*' => [
                           'id',
                           'tour_id',
                           'step',
                           'duration',
                           'playfield' => [
                               'id',
                               'type',
                               'name',
                               'maps_url',
                               'kilometers',
                               'hours',
                               'difficulty',
                               'nature',
                               'highway',
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
    public function can_return_a_collection_of_paginated_itineraries_with_playfield_OFF_route()
    {
        $route = $this->create('Playfields\Route');
        $this->create_collection('Itinerary', ['playfield_type' => 'route', 'playfield_id' => $route->id], false, 6);

        // create 1 more itinerary with other playfield type
        $this->create('Itinerary', ['playfield_type' => 'xxxx']);

        $response = $this->json('GET', "api/itineraries/playfield/route/paginate/3");

        // Assert if all itineraries have relation of type Transit
        $this->assert_if_all_objects_have_same_type_in_specified_relation($response, 'playfield', 'route');
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                    'data' => [
                        '*' => [
                           'id',
                           'tour_id',
                           'step',
                           'duration',
                           'playfield' => [
                               'id',
                               'type',
                               'name',
                               'maps_url',
                               'kilometers',
                               'hours',
                               'difficulty',
                               'nature',
                               'highway',
                               'created_at'
                           ],
                           'created_at'
                        ]
                    ],
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
    public function can_return_a_collection_of_all_itineraries_with_playfield_OFF_transit()
    {
        $transit = $this->create('Playfields\Transit');
        $this->create_collection('Itinerary', ['playfield_type' => 'transit', 'playfield_id' => $transit->id], false, 6);

        // create 1 more itinerary with other playfield type
        $this->create('Itinerary', ['playfield_type' => 'xxxx']);

        $response = $this->json('GET', "api/itineraries/playfield/transit");

        // Assert if all itineraries have relation of type Transit
        $this->assert_if_all_objects_have_same_type_in_specified_relation($response, 'playfield', 'transit');
        $response->assertStatus(200)
                 ->assertJsonCount(6, 'data')
                 ->assertJsonStructure([
                    'data' => [
                        '*' => [
                           'id',
                           'tour_id',
                           'step',
                           'duration',
                           'playfield' => [
                               'id',
                               'type',
                               'name',
                               'from',
                               'to',
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
    public function can_return_a_collection_of_paginated_itineraries_with_playfield_OFF_transit()
    {
        $transit = $this->create('Playfields\Transit');
        $this->create_collection('Itinerary', ['playfield_type' => 'transit', 'playfield_id' => $transit->id], false, 6);

        // create 1 more itinerary with other playfield type
        $this->create('Itinerary', ['playfield_type' => 'xxxx']);

        $response = $this->json('GET', "api/itineraries/playfield/transit/paginate/3");

        // Assert if all itineraries have relation of type Transit
        $this->assert_if_all_objects_have_same_type_in_specified_relation($response, 'playfield', 'transit');
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                    'data' => [
                        '*' => [
                           'id',
                           'tour_id',
                           'step',
                           'duration',
                           'playfield' => [
                               'id',
                               'type',
                               'name',
                               'from',
                               'to',
                               'created_at'
                           ],
                           'created_at'
                        ]
                    ],
                    'links' => ['first', 'last', 'prev', 'next'],
                    'meta' => [
                        'current_page', 'last_page', 'from', 'to',
                        'path', 'per_page', 'total'
                    ]
                ]);
    }
}
