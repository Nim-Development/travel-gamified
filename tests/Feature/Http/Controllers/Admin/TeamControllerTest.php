<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    // public function non_authenticated_user_can_not_access_team_api_endpoints()
    // {
    //     $this->json('GET', '/api/teams')->assertStatus(401);
    //     $this->json('GET', 'api/teams/1')->assertStatus(401);
    //     $this->json('PUT', 'api/teams/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/teams/1')->assertStatus(401);
    //     $this->json('POST', '/api/teams')->assertStatus(401);
    // }

    /**
     * @test
     */
    public function will_fail_with_a_404_if_team_is_not_found()
    {
        $res = $this->json('GET', 'api/teams/-1');
        $res->assertStatus(404);
    }

        /**
     * @test
     */
    public function will_return_204_when_requesting_all_teams_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/teams');
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_teams_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/teams/paginate/3');
        $res->assertStatus(204);
    }


    /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_team_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/teams/-1');
    //     $res->assertStatus(404);
    // }

        /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_team_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/teams/-1');
    //     $res->assertStatus(404);
    // }

    /**
     * A basic feature test example.
     * // @test << ::nk Makes it so that we dont have to add test prefix infront of each method!!
     *
     * @test
     *
     */
    // public function can_create_a_team()
    // {

    //     $faker = Factory::create();

    //     $team_data = [

    //     ];

    //     $res = $this->json('POST', '/api/teams', $team_data);

    //     // Then
    //         // Describes the outcome of Action according to conditions in Given

    //     $res->assertJsonStructure([])
    //         ->assertJson($team_data)
    //         ->assertStatus(201);

    //     // assert if the team has been added to the database
    //     $this->assertDatabaseHas('teams', $team_data);

    // }

    /**
     * @test
     */
    // public function can_update_a_team()
    // {
    //     // Given
    //     $old_team = $this->create('Team');

    //     $new_team = [
    //         'name' => $old_team->name.'_update',
    //         'slug' => $old_team->slug.'_update',
    //         'price' => $old_team->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/teams/'.$old_team->id,
    //                             $new_team);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_team);
    //     $this->assertDatabaseHas('teams', $new_team);

    // }

    /**
     * @test
     */
    // public function can_delete_a_team()
    // {
    //     // Given
    //     // first create a team in the database to delete
    //     $team = $this->create('Team');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/teams/'.$team->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $team is deleted from database
    //     $this->assertDatabaseMissing('teams', ['id' => $team->id]);
    // }
    /**
     * @test
     */
    public function returns_a_null_value_on_relationships_if_there_are_no_relationships_available()
    {
        // Given
        $team = $this->create('Team');

        // When
        $response = $this->json('GET', '/api/teams/'.$team->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                    'data' => [
                        'id' => $team->id,
                        'name' => $team->name,
                        'color' => $team->color,
                        'badge' => $team->badge,
                        'score' => $team->score,
                        'users' => null,
                        'trip' => null,
                        'created_at' => (string)$team->created_at,
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_team()
    {
        // Given
        $trip = $this->create('Trip', [], false);
        $team = $this->create('Team', ['trip_id' => $trip->id], false);

        $user_1 = $this->create('User', ['team_id' => $team->id], false);
        $user_2 = $this->create('User', ['team_id' => $team->id], false);

        // When
        $response = $this->json('GET', '/api/teams/'.$team->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                    'data' => [
                        'id' => $team->id,
                        'name' => $team->name,
                        'color' => $team->color,
                        'badge' => $team->badge,
                        'score' => $team->score,
                        'users' => [
                            [
                                'id' => $user_1->id,
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
                                'email' => $user_2->email,
                                'phone' => $user_2->phone,
                                'first_name' => $user_2->first_name,
                                'family_name' => $user_2->family_name,
                                'age' => $user_2->age,
                                'gender' => $user_2->gender,
                                'score' => $user_2->score,
                                'created_at' => (string)$user_2->created_at
                            ],
                            
                        ],
                        'trip' => [
                            'id' => $trip->id,
                            'tour_id' => $trip->tour_id,
                            'name' => $trip->name,
                            'timezone' => $trip->timezone,
                            'start_date_time' => (string)$trip->start_date_time,
                            'score' => $trip->score,
                            'created_at' => (string)$trip->created_at
                        ],
                        'created_at' => (string)$team->created_at,
                        // 'updated_at' => (string)$team->updated_at
                    ]
                ]);
    }

/**
     * @test
     */
    public function can_return_a_collection_of_all_teams()
    {
        $trip = $this->create('Trip', [], false);
        $teams = $this->create_collection('Team', ['trip_id' => $trip->id], false, 6);

        // CREATE 2 USERS PER TRIP 
        foreach($teams as $team){
            $this->create('User', ['team_id' => $team->id], false);
            $this->create('User', ['team_id' => $team->id], false);
        }

        $response = $this->json('GET', '/api/teams');

        

        $response->assertStatus(200)
                ->assertJsonCount(6, 'data')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'color',
                            'badge',
                            'score',
                            'users' => [
                                '*' => [
                                    'id',
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
                            'trip' => [
                                'id',
                                'tour_id',
                                'name',
                                'timezone',
                                'start_date_time',
                                'score',
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
    public function can_return_a_collection_of_paginated_teams()
    {
        $trip = $this->create('Trip');

        $teams = $this->create_collection('Team', ['trip_id' => $trip->id], false, 6);

        // CREATE 2 USERS PER TRIP 
        foreach($teams as $team){
            $this->create('User', ['team_id' => $team->id], false);
            $this->create('User', ['team_id' => $team->id], false);
        }

        $response = $this->json('GET', '/api/teams/paginate/3');
        $response->assertStatus(200)
                ->assertJsonCount(3, 'data')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'color',
                            'badge',
                            'score',
                            'users' => [
                                '*' => [
                                    'id',
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
                            'trip' => [
                                'id',
                                'tour_id',
                                'name',
                                'timezone',
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
