<?php

namespace Tests\Feature\Http\Controllers\Admin\TeamController;

use Faker\Factory;
use Tests\TestCase;


use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamControllerTest extends TestCase
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
    // public function non_authenticated_user_can_not_access_team_api_endpoints()
    // {
    //     $this->json('GET', '/api/teams')->assertStatus(401);
    //     $this->json('GET', 'api/teams/1')->assertStatus(401);
    //     $this->json('PUT', 'api/teams/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/teams/1')->assertStatus(401);
    //     $this->json('POST', '/api/teams')->assertStatus(401);
    // }
}

trait Get
{

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
                        'score' => $team->score,
                        'users' => null,
                        'trip' => null,
                        'badge' => null,
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

        $this->file_factory($team, 'badge', ['liverpool']);

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
                            'created_at' => (string)$trip->created_at
                        ],
                        'badge' => [
                            [
                                'def' => $team->getMedia('badge')[0]->getUrl(),
                                'md' => $team->getMedia('badge')[0]->getUrl('md'),
                                'sm' => $team->getMedia('badge')[0]->getUrl('sm'),
                                'thumb' => $team->getMedia('badge')[0]->getUrl('thumb')
                            ]
                        ],
                        'created_at' => (string)$team->created_at,
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

        foreach($teams as $team){
            $this->file_factory($team, 'badge', ['liverpool']);
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
                                'created_at'
                            ],
                            'badge' => [
                                '*' => [
                                    'def',
                                    'md',
                                    'sm',
                                    'thumb'
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
    public function can_return_a_collection_of_paginated_teams()
    {
        $trip = $this->create('Trip');

        $teams = $this->create_collection('Team', ['trip_id' => $trip->id], false, 6);

        // CREATE 2 USERS PER TRIP 
        foreach($teams as $team){
            $this->create('User', ['team_id' => $team->id], false);
            $this->create('User', ['team_id' => $team->id], false);
        }

        foreach($teams as $team){
            $this->file_factory($team, 'badge', ['liverpool']);
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
                                'created_at'
                            ],
                            'badge' => [
                                '*' => [
                                    'def',
                                    'md',
                                    'sm',
                                    'thumb'
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
    public function can_create_a_team_with_valid_badge_media_with_relational_trip_and_with_relational_users()
    {

        $body = [
            'trip_id' => $this->create('Trip')->id,
            'name' => 'sda fads',
            'color' => 'sdafas',
            'score' => 1234
        ];
        $users = [
            'users' => [
                $this->create('User')->id, 
                $this->create('User')->id, 
                $this->create('User')->id
                ] // ids of existing users.
        ];

        $files = [          
            'badge' => [
                UploadedFile::fake()->image('liverpool.jpg')            
            ]
        ];

        $res = $this->json('POST', '/api/teams', array_merge(array_merge($body, $users), $files));
        
        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'color',
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
                        'created_at'
                    ],
                    'badge' => [
                        '*' => [
                            'def',
                            'md',
                            'sm',
                            'thumb'
                        ]
                    ],
                    'created_at'
            ]
        ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('teams', $body);

        // assert if the files are uploaded to storage
        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->badge)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
    }

       /**
     * @test
     */
    public function can_create_a_team_with_valid_media_without_a_relational_trip_and_without_relational_users()
    {

        $body = [
            'name' => 'sda fads',
            'color' => 'sdafas',
            'score' => 1234
        ];

        $files = [          
            'badge' => [
                UploadedFile::fake()->image('liverpool.jpg')            
            ]
        ];

        $res = $this->json('POST', '/api/teams', array_merge($body, $files));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'color',
                    'score',
                    'users', //null
                    'trip', //null
                    'badge' => [
                        '*' => [
                            'def',
                            'md',
                            'sm',
                            'thumb'
                        ]
                    ],
                    'created_at'
            ]
        ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('teams', $body);

        // assert if the files are uploaded to storage
        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->badge)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
    }

    /**
     * @test
     */
    public function can_create_a_team_with_valid_badge_media_without_a_relational_trip_and_with_relational_users()
    {
        $body = [
            'name' => 'sda fads',
            'color' => 'sdafas',
            'score' => 1234
        ];
        $users = [
            'users' => [
                $this->create('User')->id, 
                $this->create('User')->id, 
                $this->create('User')->id
                ] // ids of existing users.
        ];

        $files = [          
            'badge' => [
                UploadedFile::fake()->image('liverpool.jpg')            
            ]
        ];

        $res = $this->json('POST', '/api/teams', array_merge(array_merge($body, $users), $files));


        
        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'color',
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
                    'trip', //null
                    'badge' => [
                        '*' => [
                            'def',
                            'md',
                            'sm',
                            'thumb'
                        ]
                    ],
                    'created_at'
            ]
        ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('teams', $body);

        // assert if the files are uploaded to storage
        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->badge)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
    }

    /**
     * @test
     */
    public function can_create_a_team_with_valid_badge_media_with_relational_trip_and_without_relational_users()
    {

        $body = [
            'trip_id' => $this->create('Trip')->id,
            'name' => 'sda fads',
            'color' => 'sdafas',
            'score' => 1234
        ];

        $files = [          
            'badge' => [
                UploadedFile::fake()->image('liverpool.jpg')            
            ]
        ];

        $res = $this->json('POST', '/api/teams', array_merge($body, $files));


        
        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'color',
                    'score',
                    'users', //null
                    'trip' => [
                        'id',
                        'tour_id',
                        'name',
                        'timezone',
                        'start_date_time',
                        'created_at'
                    ],
                    'badge' => [
                        '*' => [
                            'def',
                            'md',
                            'sm',
                            'thumb'
                        ]
                    ],
                    'created_at'
            ]
        ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('teams', $body);

        // assert if the files are uploaded to storage
        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->badge)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
    }

    /**
     * @test
     */
    public function can_create_a_team_without_badge_media()
    {

        $body = [
            'trip_id' => $this->create('Trip')->id,
            'name' => 'sda fads',
            'color' => 'sdafas',
            'score' => 1234
        ];
        $users = [
            'users' => [
                $this->create('User')->id, 
                $this->create('User')->id, 
                $this->create('User')->id
                ] // ids of existing users.
        ];

        $res = $this->json('POST', '/api/teams', array_merge($body, $users));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'color',
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
                        'created_at'
                    ],
                    'badge', //null
                    'created_at'
            ]
        ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('teams', $body);

        // assert if the files are uploaded to storage
        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->badge)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
    }

    /**
     * @test
     */
    public function will_return_error_422_if_request_body_has_a_relational_trip_id_that_doesnt_exist_in_database()
    {

        $body = [
            'trip_id' => -1,
            'name' => 'sda fads',
            'color' => 'sdafas',
            'score' => 1234
        ];

        $res = $this->json('POST', '/api/teams', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('teams', $body);
    }

    /**
     * @test
     */
    public function will_return_error_422_if_request_body_has_data_of_the_wrong_type()
    {
        // 'name' is of the wrong data type
        $body = [
            'trip_id' => $this->create('Trip')->id,
            'name' => 1234,
            'color' => 'sdafas',
            'score' => 1234
        ];

        $res = $this->json('POST', '/api/teams', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('teams', $body);
    }

        /**
     * @test
     */
    public function will_return_error_422_if_request_body_has_missing_data()
    {
        // 'name' is missing
        $body = [
            'trip_id' => $this->create('Trip')->id,
            'color' => 'sdafas',
            'score' => 1234
        ];

        $res = $this->json('POST', '/api/teams', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('teams', $body);
    }

            /**
     * @test
     */
    public function will_return_error_422_if_uploaded_file_is_of_the_wrong_type()
    {
        $body = [
            'trip_id' => $this->create('Trip')->id,
            'name' => 'sda fads',
            'color' => 'sdafas',
            'score' => 1234
        ];

        $files = [
            'badge' => [
                UploadedFile::fake()->image('liverpool.csv')  
            ]
        ];

        $res = $this->json('POST', '/api/teams', array_merge($body,$files));

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('teams', $body);
    }

}

trait Put
{
    // $body = [
    //     'trip_id' => $this->create('Trip')->id,
    //     'name' => 'sda fads',
    //     'color' => 'sdafas',
    //     'score' => 1234
    // ];
    // $users = [
    //     'users' => [
    //         $this->create('User')->id, 
    //         $this->create('User')->id, 
    //         $this->create('User')->id
    //         ] // ids of existing users.
    // ];

    // $files = [          
    //     'badge' => [
    //         UploadedFile::fake()->image('liverpool.jpg')            
    //     ]
    // ];


    /**
     * @test
     */
    public function will_fail_with_a_404_if_the_team_we_want_to_update_is_not_found()
    {
        $res = $this->json('PUT', 'api/teams/-1');
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_add_media_of_badge_collection_to_end_of_collection()
    {
        $old_values = [
            'trip_id' => $this->create('Trip')->id,
            'name' => 'sda fads',
            'color' => 'sdafas',
            'score' => 1234
        ];

        $old_team = $this->create('Team', $old_values);
        $this->file_factory($old_team, 'badge', ['badge1', 'badge2']);

        // attach users
        $users = [
            'users' => [
                $this->create('User', ['team_id' => $old_team->id])->id, 
                $this->create('User', ['team_id' => $old_team->id])->id
                ] // ids of existing users.
        ];

        $new_values = [

        ];

        $files = [          
            'badge' => [
                UploadedFile::fake()->image('badge3.jpg'),
                UploadedFile::fake()->image('badge4.jpg')     
            ]
        ];

        // When
        $res = $this->json('PUT','api/teams/'.$old_team->id, $files);

        // Then
        $res->assertStatus(200)
                    ->assertJsonCount(4, 'data.badge'); // assert that 2 images have been added to badge

        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->badge)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
    }

    /**
     * @test
     */
    public function can_add_user_to_the_end_of_relational_users_array()
    {
        $old_values = [
            'trip_id' => $this->create('Trip')->id,
            'name' => 'sda fads',
            'color' => 'sdafas',
            'score' => 1234
        ];

        $old_team = $this->create('Team', $old_values);
        $this->file_factory($old_team, 'badge', ['badge1', 'badge2']);

        // attach users
        $users = [
            'users' => [
                $this->create('User', ['team_id' => $old_team->id])->id, 
                $this->create('User', ['team_id' => $old_team->id])->id
           ] // ids of existing users.
        ];

        // 2 new users to add to team
        $new_values = [
            'users' => [
                $this->create('User')->id, 
                $this->create('User')->id, 
            ]
        ];

        // When
        $res = $this->json('PUT','api/teams/'.$old_team->id, $new_values);

        // Then
        $res->assertStatus(200)
                    ->assertJsonCount(4, 'data.users'); // assert that 2 images have been added to badge
    }

    /**
     * @test
     */
    public function can_update_team_fully_on_each_model_attribute()
    {
        $old_values = [
            'name' => 'sda fads',
            'color' => 'sdafas',
            'score' => 1234
        ];

        $trip_id = [
            'trip_id' => $this->create('Trip')->id
        ];

        $old_team = $this->create('Team', array_merge($old_values, $trip_id));

        $new_values = [
            'name' => 'aaaaaaaa',
            'color' => 'aaaaaaaa',
            'score' => 000001,
   
        ];
        $new_trip_id = [
            'trip_id' => $this->create('Trip')->id
        ];

        // When
        $res = $this->json('PUT','api/teams/'.$old_team->id, array_merge($new_values, $new_trip_id));

        // Then
        $res->assertStatus(200)
                    ->assertJsonFragment($new_values); // assert that 2 images have been added to badge

        $this->assertDatabaseHas('teams', $new_values);
        $this->assertDatabaseMissing('teams', $old_values);
    }
        /**
     * @test
     */
    public function can_update_team_on_a_couple_of_model_attributes()
    {
        $old_values = [
            'name' => 'sda fads',
            'color' => 'sdafas',
        ];

        $values_to_remain_after_update = [
            'score' => 1234
        ];

        $trip_id = [
            'trip_id' => $this->create('Trip')->id
        ];

        $old_team = $this->create('Team', array_merge(array_merge($old_values,  $values_to_remain_after_update), $trip_id));

        $new_values = [
            'name' => 'aaaaaaaa',
            'color' => 'aaaaaaaa'
        ];

        // When
        $res = $this->json('PUT','api/teams/'.$old_team->id, $new_values);

        // Then
        $res->assertStatus(200)
                    ->assertJsonFragment(array_merge($new_values, $values_to_remain_after_update));

        $this->assertDatabaseHas('teams', array_merge($new_values, $values_to_remain_after_update));
        $this->assertDatabaseMissing('teams', $old_values);
    }

    /**
     * @test
     */
    public function will_fail_with_error_422_when_body_data_is_of_wrong_type()
    {
        $old_values = [
            'name' => 'sda fads',
            'color' => 'sdafas',
            'score' => 1234
        ];

        $trip_id = [
            'trip_id' => $this->create('Trip')->id
        ];

        $old_team = $this->create('Team', array_merge($old_values, $trip_id));

        // 'name' is of wrong data type
        $new_values = [
            'name' => 000001,
            'color' => 'aaaaaaaa',
            'score' => 000002
        ];

        // When
        $res = $this->json('PUT','api/teams/'.$old_team->id, $new_values);

        // Then
        $res->assertStatus(422); 

        $this->assertDatabaseHas('teams', $old_values);
        $this->assertDatabaseMissing('teams', $new_values);
    }
        /**
     * @test
     */
    public function will_fail_with_error_422_relational_trip_does_not_exist()
    {
        $old_values = [
            'name' => 'sda fads',
            'color' => 'sdafas',
            'score' => 1234
        ];

        $trip_id = [
            'trip_id' => $this->create('Trip')->id
        ];

        $old_team = $this->create('Team', array_merge($old_values, $trip_id));

        // 'trip' does not exist
        $new_values = [
            'name' => 'aaaaa',
            'color' => 'aaaaaaaa',
            'score' => 000002,
            'trip_id' => -1
        ];

        // When
        $res = $this->json('PUT','api/teams/'.$old_team->id, $new_values);

        // Then
        $res->assertStatus(422); 

        $this->assertDatabaseHas('teams', $old_values);
        $this->assertDatabaseMissing('teams', $new_values);
    }
    
    /**
     * @test
     */
    public function will_fail_with_error_422_if_relational_user_does_not_exist()
    {
        $old_values = [
            'trip_id' => $this->create('Trip')->id,
            'name' => 'sda fads',
            'color' => 'sdafas',
            'score' => 1234
        ];

        $old_team = $this->create('Team', $old_values);
        $this->file_factory($old_team, 'badge', ['badge1', 'badge2']);

        // attach users
        $users = [
            'users' => [
                $this->create('User', ['team_id' => $old_team->id])->id, 
                $this->create('User', ['team_id' => $old_team->id])->id
           ] // ids of existing users.
        ];

        // user with id -1 does not exist
        $new_values = [
            'users' => [
                -1, 
                $this->create('User')->id, 
            ]
        ];

        // When
        $res = $this->json('PUT','api/teams/'.$old_team->id, $new_values);

        // Then
        $res->assertStatus(422); // assert that 2 images have been added to badge

        $this->assertDatabaseHas('teams', $old_values);
    }
}

trait Delete
{

       /**
     * @test
     */
    public function will_fail_with_a_404_if_the_team_we_want_to_delete_is_not_found()
    {
        $res = $this->json('DELETE', 'api/teams/-1');
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_delete_a_team_including_its_files()
    {
        // Given
        // first create a game in the database to delete
        $team = $this->create('Team');

        // attach media
        $media = ['media1', 'media2'];
        $this->file_factory($team, 'badge', $media);

        // When
        // call the delete api
        $res = $this->json('DELETE', '/api/teams/'.$team->id);

        // Then
        $res->assertStatus(204)
            ->assertSee(null);


        // check if $game is deleted from database
        $this->assertDatabaseMissing('teams', ['id' => $team->id]);

        \Storage::disk('test')->assertMissing($media);

    }

    /**
     * @test
     */
    public function can_delete_a_team_and_unlink_all_relationships()
    {
        // Given
        // first create a game in the database to delete
        $team = $this->create('Team');
        $user = $this->create('User', [
            'team_id' => $team->id
        ]);

        // When
        // call the delete api
        $res = $this->json('DELETE', '/api/teams/'.$team->id);

        // Then
        $res->assertStatus(204)
            ->assertSee(null);

        // check if $game is deleted from database
        $this->assertDatabaseMissing('teams', ['id' => $team->id]);

        $user->refresh();
        if(!$user->team_id){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }
    }

}