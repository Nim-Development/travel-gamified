<?php

namespace Tests\Feature\Http\Controllers\Admin\ItineraryController;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItineraryControllerTest extends TestCase
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
    // public function non_authenticated_user_can_not_access_itinerary_api_endpoints()
    // {
    //     $this->json('GET', '/api/itineraries')->assertStatus(401);
    //     $this->json('GET', 'api/itineraries/1')->assertStatus(401);
    //     $this->json('PUT', 'api/itineraries/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/itineraries/1')->assertStatus(401);
    //     $this->json('POST', '/api/itineraries')->assertStatus(401);
    // }
}


trait Get
{
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
                        'tour' => null,
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
        $tour = $this->create('Tour');

        $itinerary = $this->create('Itinerary', [
            'tour_id' => $tour->id,
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
                        'tour' => [
                            'id' => $tour->id,
                            'name' => $tour->name,
                            'duration' => $tour->duration,
                            'created_at' => (string)$tour->created_at
                        ],
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
        $tour = $this->create('Tour');

        $itinerary = $this->create('Itinerary', [
            'tour_id' => $tour->id,
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
                        'tour' => [
                            'id' => $tour->id,
                            'name' => $tour->name,
                            'duration' => $tour->duration,
                            'created_at' => (string)$tour->created_at
                        ],
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
        $from = $this->create('Playfields\City');
        $to = $this->create('Playfields\City');

        // Create playfield
        $playfield = $this->create('Playfields\Transit',[
            'from_city_id' => $from->id,
            'to_city_id' => $to->id
        ], false);
        $tour = $this->create('Tour');

        $itinerary = $this->create('Itinerary', [
            'tour_id' => $tour->id,
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
                        'tour' => [
                            'id' => $tour->id,
                            'name' => $tour->name,
                            'duration' => $tour->duration,
                            'created_at' => (string)$tour->created_at
                        ],
                        'step' => $itinerary->step,
                        'duration' => $itinerary->duration,
                        'playfield' => [
                            'id' => $playfield->id,
                            'type' => $itinerary->playfield_type,
                            'name' => $playfield->name,
                            'from' => [
                                'id' => $from->id,
                                'type' => 'city',
                                'short_code' => $from->short_code,
                                'name' => $from->name,
                                'created_at' => (string)$from->created_at
                            ], // City relationship
                            'to' => [
                                'id' => $to->id,
                                'type' => 'city',
                                'short_code' => $to->short_code,
                                'name' => $to->name,
                                'created_at' => (string)$to->created_at
                            ],
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
        $tour = $this->create('Tour');

        $this->create_collection('Itinerary', ['tour_id' => $tour->id, 'playfield_type' => 'city', 'playfield_id' => $city->id], false, 3);

        $response = $this->json('GET', "api/itineraries");
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                            'id',
                            'tour' => [
                                'id',
                                'name',
                                'duration',
                                'created_at'
                            ],
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
        $tour = $this->create('Tour');

        $this->create_collection('Itinerary', ['tour_id' => $tour->id,'playfield_type' => 'city', 'playfield_id' => $city->id], false, 6);

        $response = $this->json('GET', "api/itineraries/paginate/3");
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                        '*' => [ //* to say we checking keys of multiple collections
                                'id',
                                'tour' => [
                                    'id',
                                    'name',
                                    'duration',
                                    'created_at'
                                ],
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
        $tour = $this->create('Tour');

        $this->create_collection('Itinerary', ['tour_id' => $tour->id,'playfield_type' => 'city', 'playfield_id' => $city->id], false, 6);

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
                            'tour' => [
                                'id',
                                'name',
                                'duration',
                                'created_at'
                            ],
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
        $tour = $this->create('Tour');

        $this->create_collection('Itinerary', ['tour_id' => $tour->id,'playfield_type' => 'city', 'playfield_id' => $city->id], false, 6);

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
                            'tour' => [
                                'id',
                                'name',
                                'duration',
                                'created_at'
                            ],
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
        $tour = $this->create('Tour');

        $this->create_collection('Itinerary', ['tour_id' => $tour->id,'playfield_type' => 'route', 'playfield_id' => $route->id], false, 6);

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
                           'tour' => [
                                'id',
                                'name',
                                'duration',
                                'created_at'
                            ],
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
        $tour = $this->create('Tour');

        $this->create_collection('Itinerary', ['tour_id' => $tour->id,'playfield_type' => 'route', 'playfield_id' => $route->id], false, 6);

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
                           'tour' => [
                                'id',
                                'name',
                                'duration',
                                'created_at'
                            ],
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
        $transit = $this->create('Playfields\Transit', [
            'from_city_id' => $this->create('Playfields\City')->id,
            'to_city_id' => $this->create('Playfields\City')->id
        ]);
        $tour = $this->create('Tour');

        $this->create_collection('Itinerary', ['tour_id' => $tour->id,'playfield_type' => 'transit', 'playfield_id' => $transit->id], false, 6);

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
                            'tour' => [
                                'id',
                                'name',
                                'duration',
                                'created_at'
                            ],
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
        $transit = $this->create('Playfields\Transit', [
            'from_city_id' => $this->create('Playfields\City')->id,
            'to_city_id' => $this->create('Playfields\City')->id
        ]);
        $tour = $this->create('Tour');

        $this->create_collection('Itinerary', ['tour_id' => $tour->id,'playfield_type' => 'transit', 'playfield_id' => $transit->id], false, 6);

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
                            'tour' => [
                                'id',
                                'name',
                                'duration',
                                'created_at'
                            ],
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

trait Post
{

    // 
    // $table->bigIncrements('id');
    // $table->bigInteger('tour_id');
    // $table->integer('step');
    // $table->float('duration');
    // $table->string('playfield_type');
    // $table->bigInteger('playfield_id');
    // $table->timestamps();
    //
    // 'id' => $this->id,
    // 'tour_id' => (integer)$this->tour_id,
    // 'step' => (integer)$this->step,
    // 'duration' => (double)$this->duration,
    // 'playfield' => (!$playfield) ? null : $this->insert_playfield($this->playfield_type, $playfield),
    // 'created_at' => (string)$this->created_at,
    //

       /**
     * @test
     */
    public function can_create_a_itinerary_with_playfield_type_of_city()
    {

        $body = [
            'tour_id' => $this->create('Tour')->id,
            'step' => 1,
            'duration' => 12.34,
            'playfield_type' => 'city',
            'playfield_id' => $this->create('Playfields\City')->id
        ];

        $res = $this->json('POST', '/api/itineraries', $body);

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
                    'tour' => [
                        'id',
                        'name',
                        'duration',
                        'created_at'
                    ],
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
        ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('itineraries', $body);
    }

           /**
     * @test
     */
    public function can_create_a_itinerary_with_playfield_type_of_route()
    {

        $body = [
            'tour_id' => $this->create('Tour')->id,
            'step' => 1,
            'duration' => 12.34,
            'playfield_type' => 'route',
            'playfield_id' => $this->create('Playfields\Route')->id
        ];

        $res = $this->json('POST', '/api/itineraries', $body);

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
                    'tour' => [
                        'id',
                        'name',
                        'duration',
                        'created_at'
                    ],
                    'step',
                    'duration',
                    'playfield' => [
                        'id',
                        'type',
                        'transit_id',
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
        ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('itineraries', $body);
    }

           /**
     * @test
     */
    public function can_create_a_itinerary_with_playfield_type_of_transit()
    {

        $body = [
            'tour_id' => $this->create('Tour')->id,
            'step' => 1,
            'duration' => 12.34,
            'playfield_type' => 'transit',
            'playfield_id' => $this->create('Playfields\Transit', [
                'from_city_id' => $this->create('Playfields\City')->id,
                'to_city_id' => $this->create('Playfields\City')->id
            ])->id
        ];

        $res = $this->json('POST', '/api/itineraries', $body);

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
                    'tour' => [
                        'id',
                        'name',
                        'duration',
                        'created_at'
                    ],                    
                    'step',
                    'duration',
                    'playfield' => [
                        'id',
                        'type',
                        'name',
                        'from' => [
                            'id',
                            'type',
                            'short_code',
                            'name',
                            'created_at'
                        ],
                        'to' => [
                            'id',
                            'type',
                            'short_code',
                            'name',
                            'created_at'
                        ],
                        'created_at'
                    ],
                    'created_at'
                ]
        ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('itineraries', $body);
    }

    /**
     * @test
     */
    public function can_create_a_itinerary_without_a_playfield()
    {
        // 'step' is of wrong data type
        $body = [
            'tour_id' => $this->create('Tour')->id,
            'step' => 1,
            'duration' => 12.34
        ];

        $res = $this->json('POST', '/api/itineraries', $body);

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
                    'tour' => [
                        'id',
                        'name',
                        'duration',
                        'created_at'
                    ],
                    'step',
                    'duration',
                    'playfield', //NULL
                    'created_at'
                ]
        ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('itineraries', $body);
    }

        /**
     * @test
     */
    public function can_create_a_itinerary_without_a_tour()
    {
        // 'step' is of wrong data type
        $body = [
            'step' => 2,
            'duration' => 12.34,
            'playfield_type' => 'city',
            'playfield_id' => $this->create('Playfields\City')->id
        ];

        $res = $this->json('POST', '/api/itineraries', $body);

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
                    'tour',
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
        ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('itineraries', $body);
    }

            /**
     * @test
     */
    public function can_create_a_itinerary_without_a_tour_and_without_a_playfield()
    {
        // 'step' is of wrong data type
        $body = [
            'step' => 2,
            'duration' => 12.34
        ];

        $res = $this->json('POST', '/api/itineraries', $body);

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
                    'tour',
                    'step',
                    'duration',
                    'playfield', //null
                    'created_at'
                ]
        ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('itineraries', $body);
    }

    /**
     * @test
     */
    public function returns_a_error_422_if_request_body_data_is_of_incorrect_type()
    {
        // 'step' is of wrong data type
        $body = [
            'tour_id' => $this->create('Tour')->id,
            'step' => 'kjashf has kjfh',
            'duration' => 12.34,
            'playfield_type' => 'city',
            'playfield_id' => $this->create('Playfields\City')->id
        ];

        $res = $this->json('POST', '/api/itineraries', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('itineraries', $body);
    }

        /**
     * @test
     */
    public function returns_a_error_422_if_request_body_data_is_missing()
    {
        // 'step' is is missing
        $body = [
            'tour_id' => $this->create('Tour')->id,
            'duration' => 12.34,
            'playfield_type' => 'city',
            'playfield_id' => $this->create('Playfields\City')->id
        ];

        $res = $this->json('POST', '/api/itineraries', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('itineraries', $body);
    }

           /**
     * @test
     */
    public function returns_a_error_422_if_relational_playfield_of_type_city_doesnt_exist()
    {

        $body = [
            'tour_id' => $this->create('Tour')->id,
            'step' => 1,
            'duration' => 12.34,
            'playfield_type' => 'city',
            'playfield_id' => -1
        ];

        $res = $this->json('POST', '/api/itineraries', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('itineraries', $body);
    }

           /**
     * @test
     */
    public function returns_a_error_422_if_relational_playfield_of_type_route_doesnt_exist()
    {

        $body = [
            'tour_id' => $this->create('Tour')->id,
            'step' => 1,
            'duration' => 12.34,
            'playfield_type' => 'route',
            'playfield_id' => -1
        ];

        $res = $this->json('POST', '/api/itineraries', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('itineraries', $body);
    }

    /**
     * @test
     */
    public function returns_a_error_422_if_relational_playfield_of_type_transit_doesnt_exist()
    {

        $body = [
            'tour_id' => $this->create('Tour')->id,
            'step' => 1,
            'duration' => 12.34,
            'playfield_type' => 'transit',
            'playfield_id' => -1
        ];

        $res = $this->json('POST', '/api/itineraries', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('itineraries', $body);
    }

        /**
     * @test
     */
    public function returns_a_error_422_if_relational_tour_doesnt_exist()
    {

        $body = [
            'tour_id' => -1,
            'step' => 1,
            'duration' => 12.34,
            'playfield_type' => 'city',
            'playfield_id' => $this->create('Playfields\City')->id
        ];

        $res = $this->json('POST', '/api/itineraries', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('itineraries', $body);
    }
}

trait Put
{
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
}

trait Delete
{
    /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_itinerary_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/itineraries/-1');
    //     $res->assertStatus(404);
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


}