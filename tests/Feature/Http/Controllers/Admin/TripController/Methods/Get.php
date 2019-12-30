<?php 

namespace Tests\Feature\Http\Controllers\Admin\TripController;

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
                                'badge' => $team_1->badge,
                                'score' => $team_1->score,
                                'created_at' => (string)$team_1->created_at
                            ],
                            [
                                'id' => $team_2->id,
                                'name' => $team_2->name,
                                'color' => $team_2->color,
                                'badge' => $team_2->badge,
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
                                    'badge',
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
                                    'badge',
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


