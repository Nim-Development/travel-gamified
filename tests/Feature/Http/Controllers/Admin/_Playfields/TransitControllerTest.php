<?php

namespace Tests\Feature\Http\Controllers\Admin\Playfields\TransitController;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransitControllerTest extends TestCase
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
    // public function non_authenticated_user_can_not_access_transit_api_endpoints()
    // {
    //     $this->json('GET', '/api/transits')->assertStatus(401);
    //     $this->json('GET', 'api/transits/1')->assertStatus(401);
    //     $this->json('PUT', 'api/transits/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/transits/1')->assertStatus(401);
    //     $this->json('POST', '/api/transits')->assertStatus(401);
    // }

}


trait Get
{
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
    public function will_return_204_when_requesting_all_transits_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/transits');
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_transits_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/transits/paginate/3');
        $res->assertStatus(204);
    }


    /**
     * @test
     */
    public function returns_a_null_value_on_relationships_if_there_are_no_relationships_available()
    {
        // EXCEPT FOR CITY RELATIONSHIP (FROM & TO), THESE ARE ALWAYS REQUIRED

        $from = $this->create('Playfields\City');
        $to = $this->create('Playfields\City');

        // Given
        // Create transit without any relationships
        $transit = $this->create('Playfields\Transit', [
            'from_city_id' => $from->id,
            'to_city_id' => $to->id
        ]);
    
        // When
        $response = $this->json('GET', '/api/transits/'.$transit->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                    'data' => [
                        'id' => $transit->id,
                        'name' => $transit->name,
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
                        ], // City relationship
                        'itinerary' => null,
                        'routes' => null,
                        'challenges' => null,
                        'created_at' => (string)$transit->created_at,
                    ]
                ]);
    }


    /**
     * @test
     */
    public function can_return_a_transit()
    {

        $from = $this->create('Playfields\City');
        $to = $this->create('Playfields\City');

        // Given
        // inserting a model into the database (we know this will work because test can_create_a_transit() was asserted succesfully)
        $transit = $this->create('Playfields\Transit', [
            'from_city_id' => $from->id,
            'to_city_id' => $to->id
        ]);

        /** Link 2 Routes to transit */
        $route_1 = $this->create('Playfields\Route', ['transit_id' => $transit->id]);
        $route_2 = $this->create('Playfields\Route', ['transit_id' => $transit->id]);

        // insert game into challenge & insert playfield into challenge.
        $game_1  = $this->create('Games\GameTextAnswere');
        $challenge_1 = $this->create('Games\Challenge', [
                'game_type' => 'text_answere', 
                'game_id' => $game_1->id,
                'playfield_type' => 'transit',
                'playfield_id' => $transit->id
            ]);
        
        // insert game into challenge
        $game_2 = $this->create('Games\GameTextAnswere');
        $challenge_2 = $this->create('Games\Challenge', [
            'game_type' => 'text_answere', 
            'game_id' => $game_2->id,
            'playfield_type' => 'transit',
            'playfield_id' => $transit->id
        ]);

        // link itinerary to Transit
        $itinerary  = $this->create('Itinerary', [
            'playfield_type' => 'transit',
            'playfield_id' => $transit->id
        ]);
            
        // When
        $response = $this->json('GET', '/api/transits/'.$transit->id);
            
        // Then
        // assert status code
        $response->assertStatus(200)
                
                // !!! PROBLEM: routes->highway komen niet overeen... de rest van de properties well.. vage shit.
                 ->assertExactJson([
                    'data' => [
                        'id' => $transit->id,
                        'name' => $transit->name,
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
                        ], // City relationship
                        'itinerary' => [
                            'id' => $itinerary->id,
                            'step' => (integer)$itinerary->step,
                            'duration' => (double)$itinerary->duration,
                            'created_at' => (string)$itinerary->created_at,
                        ],
                        'routes' => [
                            [
                                'id' => (integer)$route_1->id,
                                'name' => $route_1->name,
                                'maps_url' => $route_1->maps_url,
                                'kilometers' => (double)$route_1->kilometers,
                                'hours' => (double)$route_1->hours,
                                'difficulty' => (integer)$route_1->difficulty,
                                'nature' => (integer)$route_1->nature,
                                'highway' => (integer)$route_1->highway,
                                'created_at' => (string)$route_1->created_at
                            ],
                            [
                                'id' => (integer)$route_2->id,
                                'name' => $route_2->name,
                                'maps_url' => $route_2->maps_url,
                                'kilometers' => (double)$route_2->kilometers,
                                'hours' => (double)$route_2->hours,
                                'difficulty' => (integer)$route_2->difficulty,
                                'nature' => (integer)$route_2->nature,
                                'highway' => (integer)$route_2->highway,
                                'created_at' => (string)$route_2->created_at
                            ]
                        ],
                        'challenges' => [
                            [
                                'id' => $challenge_1->id,
                                'sort_order' => $challenge_1->sort_order,
                                'game' => [
                                    'id' => (integer)$challenge_1->game->id,
                                    'type' => $challenge_1->game->type,
                                    'title' => $challenge_1->game->title,
                                    'content_text' => $challenge_1->game->content_text,
                                    'correct_answere' => $challenge_1->game->correct_answere,
                                    'points_min' => (integer)$challenge_1->game->points_min,
                                    'points_max' => (integer)$challenge_1->game->points_max,
                                    'created_at' => (string)$challenge_1->game->created_at
                                ],
                                'created_at' => (string)$challenge_1->created_at
                            ],
                            [
                                'id'  => $challenge_2->id,
                                'sort_order'  => $challenge_2->sort_order,
                                'game' => [
                                    'id' => (integer)$challenge_2->game->id,
                                    'type' => $challenge_2->game->type,
                                    'title' => $challenge_2->game->title,
                                    'content_text' => $challenge_2->game->content_text,
                                    'correct_answere' => $challenge_2->game->correct_answere,
                                    'points_min' => (integer)$challenge_2->game->points_min,
                                    'points_max' => (integer)$challenge_2->game->points_max,
                                    'created_at' => (string)$challenge_2->game->created_at
                                ],
                                'created_at' => (string)$challenge_2->created_at
                            ]
                        ],
                        'created_at' => (string)$transit->created_at,
                    ]
                ]);
    }


    /**
     * @test
     */
    public function can_return_a_collection_of_all_transits()
    {   
        $from = $this->create('Playfields\City');
        $to = $this->create('Playfields\City');

        $transits = $this->create_collection('Playfields\Transit', [
            'from_city_id' => $from->id,
            'to_city_id' => $to->id
        ], false, 3);

        // generates a collection of transits and creates / links all relational data.
        $this->insert_relations_into_transit_collection($transits, 'text_answere');

        $response = $this->json('GET', '/api/transits');
        $response->assertStatus(200)
                ->assertJsonCount(3, 'data')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
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
                            'itinerary' => [
                                'id',
                                'step',
                                'duration',
                                'created_at'
                            ],
                            'routes' => [
                                '*' =>
                                    [
                                        'id',
                                        'name',
                                        'maps_url',
                                        'kilometers',
                                        'hours',
                                        'difficulty',
                                        'nature',
                                        'highway',
                                        'created_at'
                                    ]
                            ],
                            'challenges' => [
                                '*' =>
                                    [
                                        'id',
                                        'sort_order',
                                        'game' => [
                                            'id',
                                            'type',
                                            'title',
                                            'content_text',
                                            'correct_answere',
                                            'points_min',
                                            'points_max',
                                            'created_at'
                                        ],
                                        'created_at'
                                    ]
                            ],
                            'created_at'
                        ]
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_paginated_transits()
    {
        $from = $this->create('Playfields\City');
        $to = $this->create('Playfields\City');

        $transits = $this->create_collection('Playfields\Transit', [
            'from_city_id' => $from->id,
            'to_city_id' => $to->id
        ], false, 6);

        // generates a collection of transits and creates / links all relational data.
        $this->insert_relations_into_transit_collection($transits, 'text_answere');

        $response = $this->json('GET', '/api/transits/paginate/3');
        $response->assertStatus(200)
                ->assertJsonCount(3, 'data')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
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
                            'itinerary' => [
                                'id',
                                'step',
                                'duration',
                                'created_at'
                            ],
                            'routes' => [
                                '*' =>
                                    [
                                        'id',
                                        'name',
                                        'maps_url',
                                        'kilometers',
                                        'hours',
                                        'difficulty',
                                        'nature',
                                        'highway',
                                        'created_at'
                                    ]
                            ],
                            'challenges' => [
                                '*' =>
                                    [
                                        'id',
                                        'sort_order',
                                        'game' => [
                                            'id',
                                            'type',
                                            'title',
                                            'content_text',
                                            'correct_answere',
                                            'points_min',
                                            'points_max',
                                            'created_at'
                                        ],
                                        'created_at'
                                    ]
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

trait Post
{
    /**
     * @test
     */
    public function can_create_a_transit_with_routes()
    {
        $body = [
            'name' => 'sdad hx as hh dsuah ihas',
            'from_city_id' => $this->create('Playfields\City')->id,
            'to_city_id' => $this->create('Playfields\City')->id
        ];
        $routes = [
            'routes' => [
                $this->create('Playfields\Route')->id,
                $this->create('Playfields\Route')->id,
                $this->create('Playfields\Route')->id,
            ] // route ids
        ];

        $res = $this->json('POST', '/api/transits', array_merge($body, $routes));

        // the 3 relationships will always be null at first create, because the relational models hold all the foreign keys.
        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
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
                    'itinerary', //null
                    'routes' => [
                        '*' => [
                            'id',
                            'name',
                            'maps_url',
                            'kilometers',
                            'hours',
                            'difficulty',
                            'nature',
                            'highway',
                            'created_at'
                        ]
                    ],
                    'challenges', //null
                    'created_at'
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('transits', $body);
    }


        /**
     * @test
     */
    public function can_create_a_transit_without_routes()
    {
        $body = [
            'name' => 'sdad hx as hh dsuah ihas',
            'from_city_id' => $this->create('Playfields\City')->id,
            'to_city_id' => $this->create('Playfields\City')->id
        ];

        $res = $this->json('POST', '/api/transits', $body);

        // the 3 relationships will always be null at first create, because the relational models hold all the foreign keys.
        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
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
                    'itinerary', //null
                    'routes',
                    'challenges', //null
                    'created_at'
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('transits', $body);
    }

        /**
     * @test
     */
    public function will_fail_with_a_422_if_relational_from_city_does_not_exist_in_database()
    {
        // 'name' is wrong data type
        $body = [
            'name' => 'sadasasd',
            'from_city_id' => -1,
            'to_city_id' => $this->create('Playfields\City')->id
        ];

        $res = $this->json('POST', '/api/transits', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('transits', $body);
    }

            /**
     * @test
     */
    public function will_fail_with_a_422_if_relational_to_city_does_not_exist_in_database()
    {
        // 'name' is wrong data type
        $body = [
            'name' => 'addasads',
            'from_city_id' => $this->create('Playfields\City')->id,
            'to_city_id' => -1
        ];

        $res = $this->json('POST', '/api/transits', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('transits', $body);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_body_failed_validation_because_of_wrong_data_types_in_body()
    {
        // 'name' is wrong data type
        $body = [
            'name' => 234,
            'from_city_id' => $this->create('Playfields\City')->id,
            'to_city_id' => $this->create('Playfields\City')->id
        ];

        $res = $this->json('POST', '/api/transits', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('transits', $body);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_body_failed_validation_because_data_was_missing_from_body()
    {
        // 'name' is missing
        $body = [
            'from_city_id' => $this->create('Playfields\City')->id,
            'to_city_id' => $this->create('Playfields\City')->id
        ];

        $res = $this->json('POST', '/api/transits', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('transits', $body);
    }

}

trait Put
{
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
    // public function can_update_a_transit()
    // {
    //     // Given
    //     $old_transit = $this->create('Playfields\Transit');

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
    //     $this->assertDatabaseHas('Playfields\Transits', $new_transit);

    // }
}

trait Delete
{
           /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_transit_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/transits/-1');
    //     $res->assertStatus(404);
    // }

    /**
     * @test
     */
    // public function can_delete_a_transit()
    // {
    //     // Given
    //     // first create a transit in the database to delete
    //     $transit = $this->create('Playfields\Transit');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/transits/'.$transit->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $transit is deleted from database
    //     $this->assertDatabaseMissing('Playfields\Transits', ['id' => $transit->id]);
    // }


}