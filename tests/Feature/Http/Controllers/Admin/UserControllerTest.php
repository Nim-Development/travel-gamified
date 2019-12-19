<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    // public function non_authenticated_user_can_not_access_user_api_endpoints()
    // {
    //     $this->json('GET', '/api/users')->assertStatus(401);
    //     $this->json('GET', 'api/users/1')->assertStatus(401);
    //     $this->json('PUT', 'api/users/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/users/1')->assertStatus(401);
    //     $this->json('POST', '/api/users')->assertStatus(401);
    // }

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
    // public function will_fail_with_a_404_if_the_user_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/users/-1');
    //     $res->assertStatus(404);
    // }

        /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_user_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/users/-1');
    //     $res->assertStatus(404);
    // }

    /**
     * A basic feature test example.
     * // @test << ::nk Makes it so that we dont have to add test prefix infront of each method!!
     *
     * @test
     *
     */
    // public function can_create_a_user()
    // {

    //     $faker = Factory::create();

    //     $user_data = [

    //     ];

    //     $res = $this->json('POST', '/api/users', $user_data);

    //     // Then
    //         // Describes the outcome of Action according to conditions in Given

    //     $res->assertJsonStructure([])
    //         ->assertJson($user_data)
    //         ->assertStatus(201);

    //     // assert if the user has been added to the database
    //     $this->assertDatabaseHas('users', $user_data);

    // }

    /**
     * @test
     */
    // public function can_update_a_user()
    // {
    //     // Given
    //     $old_user = $this->create('User');

    //     $new_user = [
    //         'name' => $old_user->name.'_update',
    //         'slug' => $old_user->slug.'_update',
    //         'price' => $old_user->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/users/'.$old_user->id,
    //                             $new_user);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_user);
    //     $this->assertDatabaseHas('users', $new_user);

    // }

    /**
     * @test
     */
    // public function can_delete_a_user()
    // {
    //     // Given
    //     // first create a user in the database to delete
    //     $user = $this->create('User');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/users/'.$user->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $user is deleted from database
    //     $this->assertDatabaseMissing('users', ['id' => $user->id]);
    // }

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
                    'id' => $user->id,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'email_verified_at' => $user->email_verified_at,
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
                        'start_date_time' => $trip->start_date_time,
                        'score' => $trip->score,
                        'created_at' => $trip->created_at,
                    ],
                    'created_at' => (string)$user->created_at
                    // 'updated_at' => (string)$user->updated_at
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_all_users()
    {

        $team = $this->create('Team');
        $trip = $this->create('Trip');

        $user_1 = $this->create('User', ['team_id' => $team->id, 'trip_id' => $trip->id]);
        $user_2 = $this->create('User', ['team_id' => $team->id, 'trip_id' => $trip->id]);
        $user_3 = $this->create('User', ['team_id' => $team->id, 'trip_id' => $trip->id]);
        $user_4 = $this->create('User', ['team_id' => $team->id, 'trip_id' => $trip->id]);
        $user_5 = $this->create('User', ['team_id' => $team->id, 'trip_id' => $trip->id]);
        $user_6 = $this->create('User', ['team_id' => $team->id, 'trip_id' => $trip->id]);

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

        $user_1 = $this->create('User', ['team_id' => $team->id, 'trip_id' => $trip->id]);
        $user_2 = $this->create('User', ['team_id' => $team->id, 'trip_id' => $trip->id]);
        $user_3 = $this->create('User', ['team_id' => $team->id, 'trip_id' => $trip->id]);
        $user_4 = $this->create('User', ['team_id' => $team->id, 'trip_id' => $trip->id]);
        $user_5 = $this->create('User', ['team_id' => $team->id, 'trip_id' => $trip->id]);
        $user_6 = $this->create('User', ['team_id' => $team->id, 'trip_id' => $trip->id]);

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
