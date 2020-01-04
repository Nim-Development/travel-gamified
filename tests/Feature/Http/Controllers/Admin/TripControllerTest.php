<?php

namespace Tests\Feature\Http\Controllers\Admin\TripController;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TripControllerTest extends TestCase
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
    // public function non_authenticated_user_can_not_access_trip_api_endpoints()
    // {
    //     $this->json('GET', '/api/trips')->assertStatus(401);
    //     $this->json('GET', 'api/trips/1')->assertStatus(401);
    //     $this->json('PUT', 'api/trips/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/trips/1')->assertStatus(401);
    //     $this->json('POST', '/api/trips')->assertStatus(401);
    // }
}

trait Get
{
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
    public function will_return_204_when_requesting_all_trips_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/trips');
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_trips_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/trips/paginate/3');
        $res->assertStatus(204);
    }

        /**
     * @test
     */
    public function returns_a_null_value_on_relationships_if_there_are_no_relationships_available()
    {
        // Given
        $trip = $this->create('Trip');

        // When
        $response = $this->json('GET', '/api/trips/'.$trip->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                    'data' => [
                        'id' => $trip->id,
                        'name' => $trip->name,
                        'timezone' => $trip->timezone,
                        'start_date_time' => (string)$trip->start_date_time,
                        'tour' => null,
                        'teams' => null,
                        'users' => null,
                        'created_at' => (string)$trip->created_at
                        // 'updated_at' => (string)$trip->updated_at
                    ]
                ]);
    }


    /**
     * @test
     */
    public function can_return_a_trip()
    {
        // Given
        $tour = $this->create('Tour');
        $trip = $this->create('Trip', ['tour_id' => $tour->id]);


        // create 2 teams, link them to trip
        $team_1 = $this->create('Team', ['trip_id' => $trip->id]);
        $team_2 = $this->create('Team', ['trip_id' => $trip->id]);

        // create 2 users, link them to trip and team
        $user_1 = $this->create('User', ['trip_id' => $trip->id, 'team_id' => $team_1->id]);
        $user_2 = $this->create('User', ['trip_id' => $trip->id, 'team_id' => $team_2->id]);

        // When
        $response = $this->json('GET', '/api/trips/'.$trip->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                    'data' => [
                        'id' => $trip->id,
                        'name' => $trip->name,
                        'timezone' => $trip->timezone,
                        'start_date_time' => (string)$trip->start_date_time,
                        'tour' => [
                            'id' => $tour->id,
                            'name' => $tour->name,
                            'duration' => $tour->duration,
                            'created_at' => (string)$tour->created_at
                        ],
                        'teams' => [
                            [
                                'id' => $team_1->id,
                                'name' => $team_1->name,
                                'color' => $team_1->color,
                                'score' => $team_1->score,
                                'created_at' => (string)$team_1->created_at
                            ],
                            [
                                'id' => $team_2->id,
                                'name' => $team_2->name,
                                'color' => $team_2->color,
                                'score' => $team_2->score,
                                'created_at' => (string)$team_2->created_at
                            ]
                        ],
                        'users' => [
                            [
                                'id' => $user_1->id,
                                'team_id' => $user_1->team_id,
                                'email' => $user_1->email,
                                'phone' => $user_1->phone,
                                'first_name' => $user_1->first_name,
                                'family_name' => $user_1->family_name,
                                'age' => $user_1->age,
                                'gender' => $user_1->gender,
                                'score' => $user_1->score,
                                'created_at' => (string)$user_1->created_at
                            ],
                            [
                                'id' => $user_2->id,
                                'team_id' => $user_2->team_id,
                                'email' => $user_2->email,
                                'phone' => $user_2->phone,
                                'first_name' => $user_2->first_name,
                                'family_name' => $user_2->family_name,
                                'age' => $user_2->age,
                                'gender' => $user_2->gender,
                                'score' => $user_2->score,
                                'created_at' => (string)$user_2->created_at
                            ]
                        ],
                        'created_at' => (string)$trip->created_at
                        // 'updated_at' => (string)$trip->updated_at
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_all_trips()
    {

        $trips = $this->create_collection('Trip', [], false, 6);
        
        $this->insert_relations_into_trip_collection($trips);

        $response = $this->json('GET', '/api/trips');
        
        $response->assertStatus(200)
                ->assertJsonCount(6, 'data')
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
                            'teams' => [
                                '*' => [
                                    'id',
                                    'name',
                                    'color',
                                    'score',
                                    'created_at'
                                ]
                            ],
                            'users' => [
                                '*' => [
                                    'id',
                                    'team_id',
                                    'email',
                                    'phone',
                                    'first_name',
                                    'family_name',
                                    'age',
                                    'gender',
                                    'score',
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
    public function can_return_a_collection_of_paginated_trips()
    {

        $trips = $this->create_collection('Trip', [], false, 6);
        $this->insert_relations_into_trip_collection($trips);

        $response = $this->json('GET', '/api/trips/paginate/3');

        $response->assertStatus(200)
                ->assertJsonCount(3, 'data')
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
                            'teams' => [
                                '*' => [
                                    'id',
                                    'name',
                                    'color',
                                    'score',
                                    'created_at'
                                ]
                            ],
                            'users' => [
                                '*' => [
                                    'id',
                                    'team_id',
                                    'email',
                                    'phone',
                                    'first_name',
                                    'family_name',
                                    'age',
                                    'gender',
                                    'score',
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

    // $table->bigIncrements('id');

    // $table->bigInteger('tour_id');
    // $table->string('name');
    // $table->string('timezone');
    // $table->dateTime('start_date_time')->nullable();
    // $table->bigInteger('score');

    // $table->timestamps();

    // 'id' => (integer)$this->id,
    // 'name' => $this->name,
    // 'timezone' => (string)$this->timezone,
    // 'start_date_time' => (string)$this->start_date_time,
    // 'tour' => (!$tour) ? null :
    //     [
    //         'id' => (integer)$tour->id,
    //         'name' => $tour->name,
    //         'duration' => (double)$tour->duration,
    //         'created_at' => (string)$tour->created_at
    //     ],
    // 'teams' => (!$teams) ? null : $this->insert_teams_into_trip($teams),
    // 'users' => (!$users) ? null : $this->insert_users_into_trip($users),
    // 'created_at' => (string)$this->created_at


    /**
     * @test
     */
    public function can_create_a_trip_with_relational_tour_id_and_relational_teams()
    {

        $body = [
            'tour_id' => $this->create('Tour')->id,
            'name' => 'aad ijasf ijsoadfjoiasd',
            'timezone' => 'GMT+7'
        ];
        $date_time = [
            'start_date_time' => now()
        ];
        $teams = [
            'teams' => [
                $this->create('Team')->id,
                $this->create('Team')->id,
                $this->create('Team')->id
            ] // existing team ids.
        ];

        $res = $this->json('POST', '/api/trips', array_merge(array_merge($body, $date_time), $teams));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'timezone',
                    'start_date_time',
                    'tour' =>
                        [
                            'id',
                            'name',
                            'duration',
                            'created_at'
                        ],
                    'teams' => [
                        '*' => [
                            'id',
                            'name',
                            'color',
                            'score',
                            'created_at'
                        ]
                    ],
                    'users', //NULL (because foreign key is at users table)
                    'created_at'
                ]
        ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('trips', $body);
    }


    /**
     * @test
     */
    public function can_create_a_trip_with_relational_tour_id_and_without_relational_teams()
    {
        $now = now();

        $body = [
            'tour_id' => $this->create('Tour')->id,
            'name' => 'aad ijasf ijsoadfjoiasd',
            'timezone' => 'GMT+7'
        ];
        $date_time = [
            'start_date_time' => now()
        ];


        $res = $this->json('POST', '/api/trips', array_merge($body, $date_time));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'timezone',
                    'start_date_time',
                    'tour' =>
                        [
                            'id',
                            'name',
                            'duration',
                            'created_at'
                        ],
                    'teams', //Null
                    'users', //NULL (because foreign key is at users table)
                    'created_at'
                ]
        ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('trips', $body);
    }


    /**
     * @test
     */
    public function will_fail_with_error_422_if_relational_tour_id_does_not_exist_in_database()
    {

        $body = [
            'tour_id' => -1,
            'name' => 'aad ijasf ijsoadfjoiasd',
            'timezone' => 'GMT+7',
            'start_date_time' => now()
        ];

        $res = $this->json('POST', '/api/trips', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('trips', $body);
    }

    /**
     * @test
     */
    public function will_fail_with_error_422_if_request_body_data_type_is_incorrect()
    {

        // 'name' is of wrong data type
        $body = [
            'tour_id' => $this->create('Tour')->id,
            'name' => 1234,
            'timezone' => 'GMT+7',
            'start_date_time' => now()
        ];

        $res = $this->json('POST', '/api/trips', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('trips', $body);
    }

        /**
     * @test
     */
    public function will_fail_with_error_422_if_request_body_data_is_missing()
    {

        // 'name' is missing
        $body = [
            'tour_id' => $this->create('Tour')->id,
            'timezone' => 'GMT+7',
            'start_date_time' => now(),
        ];

        $res = $this->json('POST', '/api/trips', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('trips', $body);
    }


}

trait Put
{
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
}

trait Delete
{

        /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_trip_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/trips/-1');
    //     $res->assertStatus(404);
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
}


