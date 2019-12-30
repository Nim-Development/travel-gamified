<?php 

namespace Tests\Feature\Http\Controllers\Admin\UserController;

trait Get
{
    /**
     * @test
     */
    public function will_fail_with_a_404_if_user_is_not_found()
    {
        $res = $this->json('GET', 'api/users/-1');
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_all_users_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/users');
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_users_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/users/paginate/3');
        $res->assertStatus(204);
    }

        /**
     * @test
     */
    public function returns_a_null_value_on_relationships_if_there_are_no_relationships_available()
    {
        // Given
        $user = $this->create('User');

        // When
        $response = $this->json('GET', '/api/users/'.$user->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([ 
                    'data' => [
                        'id' => $user->id,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'email_verified_at' => (string)$user->email_verified_at,
                        'first_name' => $user->first_name,
                        'family_name' => $user->family_name,
                        'age' => $user->age,
                        'gender' => $user->gender,
                        'score' => $user->score,
                        'team' => null,
                        'trip' => null,
                        'created_at' => (string)$user->created_at
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_user()
    {
        // Given
        // inserting a model into the database (we know this will work because test can_create_a_user() was asserted succesfully)
        $team = $this->create('Team');
        $trip = $this->create('Trip');
        $user = $this->create('User', ['team_id' => $team->id, 'trip_id' => $trip->id]);

        // When
        $response = $this->json('GET', '/api/users/'.$user->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([ 
                    'data' => [
                        'id' => $user->id,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'email_verified_at' => (string)$user->email_verified_at,
                        'first_name' => $user->first_name,
                        'family_name' => $user->family_name,
                        'age' => $user->age,
                        'gender' => $user->gender,
                        'score' => $user->score,
                        'team' => [
                            'id' => $team->id,
                            'name' => $team->name,
                            'color' => $team->color,
                            'badge' => $team->badge,
                            'score' => $team->score,
                            'created_at' => (string)$team->created_at
                        ],
                        'trip' => [
                            'id' => $trip->id,
                            'tour_id' => $trip->tour_id,
                            'name' => $trip->name,
                            'start_date_time' => (string)$trip->start_date_time,
                            'score' => $trip->score,
                            'created_at' => (string)$trip->created_at,
                        ],
                        'created_at' => (string)$user->created_at
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_all_users()
    {

        $team = $this->create('Team');
        $trip = $this->create('Trip');

        $this->create_collection('User', ['team_id' => $team->id, 'trip_id' => $trip->id], false, 6);

        $response = $this->json('GET', '/api/users');

        $response->assertStatus(200)
                ->assertJsonCount(6, 'data')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections
                            'id',
                            'email',
                            'phone',
                            'email_verified_at',
                            'first_name',
                            'family_name',
                            'age',
                            'gender',
                            'score',
                            'team' => [
                                'id',
                                'name',
                                'color',
                                'badge',
                                'score',
                                'created_at'
                            ],
                            'trip' => [
                                'id',
                                'tour_id',
                                'name',
                                'start_date_time',
                                'score',
                                'created_at'
                            ],
                            'created_at'
                        ]
                    ],
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_paginated_users()
    {
        $team = $this->create('Team');
        $trip = $this->create('Trip');

        $this->create_collection('User', ['team_id' => $team->id, 'trip_id' => $trip->id], false, 6);

        $response = $this->json('GET', '/api/users/paginate/3');

        $response->assertStatus(200)
                ->assertJsonCount(3, 'data')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections
                            'id',
                            'email',
                            'phone',
                            'email_verified_at',
                            'first_name',
                            'family_name',
                            'age',
                            'gender',
                            'score',
                            'team' => [
                                'id',
                                'name',
                                'color',
                                'badge',
                                'score',
                                'created_at'
                            ],
                            'trip' => [
                                'id',
                                'tour_id',
                                'name',
                                'start_date_time',
                                'score',
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


