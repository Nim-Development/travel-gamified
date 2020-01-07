<?php

namespace Tests\Feature\Http\Controllers\Admin\AnswereController;

use Faker\Factory;
use Tests\TestCase;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnswereControllerTest extends TestCase
{

    use RefreshDatabase;
    // Include the different tests (seperated by API type)
    use Get;
    use Post;
    use Put;
    use Delete;
    // /**
    //  * @test
    //  */
    // public function non_authenticated_user_can_not_access_answere_api_endpoints()
    // {
    //     $this->json('GET', '/api/answeres')->assertStatus(401);
    //     $this->json('GET', 'api/answeres/1')->assertStatus(401);
    //     $this->json('PUT', 'api/answeres/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/answeres/1')->assertStatus(401);
    //     $this->json('POST', '/api/answeres')->assertStatus(401);
    // }
}


trait Get
{
    /**
     * @test
     */
    public function will_fail_with_a_404_if_answere_is_not_found()
    {
        $res = $this->json('GET', '/api/answeres/checked/-1');
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_all_checked_answeres_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/answeres/checked');
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_all_unchecked_answeres_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/answeres/unchecked');
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_checked_answeres_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/answeres/checked/paginate/3');
        $res->assertStatus(204);
    }

        /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_unchecked_answeres_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/answeres/unchecked/paginate/3');
        $res->assertStatus(204);
    }

        /**
     * @test
     */
    public function will_fail_with_a_400_if_we_try_to_return_a_single_answere_of_an_invalid_type()
    {
        $res = $this->json('GET', '/api/answeres/answeres/1');
        $res->assertStatus(400);
    }

    /**
     * @test
     */
    public function will_fail_with_a_400_if_we_try_to_return_all_answeres_of_an_invalid_type()
    {
        $res = $this->json('GET', '/api/answeres/answeres');
        $res->assertStatus(400);
    }

    /**
     * @test
     */
    public function will_fail_with_a_400_if_we_try_to_return_paginated_answeres_of_an_invalid_type()
    {
        $res = $this->json('GET', '/api/answeres/answeres/paginate/3');
        $res->assertStatus(400);
    }

        /**
     * @test
     */
    public function can_get_all_unchecked_answeres()
    {
        // Create 3 Checked
        $this->collection_of_answeres('AnswereChecked', 3);

        // Create 3 Unchecked
        $answeres_uncheckeds = $this->collection_of_answeres('AnswereUnchecked', 3);

        foreach($answeres_uncheckeds as $answeres_unchecked){
            $this->file_factory($answeres_unchecked, 'submission', ['chelsea']); // add 1 submission per answere
        }
        
        $response = $this->json('GET', '/api/answeres/unchecked');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'answere',
                            'score',
                            'created_at',
                            'user' => [
                                'id',
                                'email',
                                'phone',
                                'email_verified_at',
                                'first_name',
                                'family_name',
                                'age',
                                'gender',
                                'score',
                                'created_at'
                            ],
                            'challenge' => [
                                'id',
                                'sort_order',
                                'playfield' => [
                                    'id',
                                    'type',
                                    'short_code',
                                    'name'
                                ],
                                'game' => [
                                    'id',
                                    'type',
                                    'title',
                                    'content_text',
                                    'correct_answere',
                                    'points_min',
                                    'points_max',
                                    'created_at'
                                ]
                            ],
                            'media_submission' => [
                                '*' => [
                                    'def',
                                    'md',
                                    'sm',
                                    'thumb'
                                ]
                            ]
                        ]
                    ]
                 ]);

    }

    /**
     * @test
     */
    public function can_get_all_unchecked_answeres_paginated()
    {
        // Create 3 Checked
        $this->collection_of_answeres('AnswereChecked', 3);

        // Create 3 Unchecked
        $answeres_uncheckeds = $this->collection_of_answeres('AnswereUnchecked', 6);

        foreach($answeres_uncheckeds as $answeres_unchecked){
            $this->file_factory($answeres_unchecked, 'submission', ['chelsea']); // add 1 submission per answere
        }

        $response = $this->json('GET', '/api/answeres/unchecked/paginate/3');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'answere',
                            'score',
                            'created_at',
                            'user' => [
                                'id',
                                'email',
                                'phone',
                                'email_verified_at',
                                'first_name',
                                'family_name',
                                'age',
                                'gender',
                                'score',
                                'created_at'
                            ],
                            'challenge' => [
                                'id',
                                'sort_order',
                                'playfield' => [
                                    'id',
                                    'type',
                                    'short_code',
                                    'name'
                                ],
                                'game' => [
                                    'id',
                                    'type',
                                    'title',
                                    'content_text',
                                    'correct_answere',
                                    'points_min',
                                    'points_max',
                                    'created_at'
                                ]
                            ],
                            'media_submission' => [
                                '*' => [
                                    'def',
                                    'md',
                                    'sm',
                                    'thumb'
                                ]
                            ]
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
    public function can_get_all_checked_answeres()
    {
        // Create 3 Checked
        $answeres_checkeds = $this->collection_of_answeres('AnswereChecked', 3);

        foreach($answeres_checkeds as $answeres_checked){
            $this->file_factory($answeres_checked, 'submission', ['chelsea']); // add 1 submission per answere
        }

        // Create 3 Unchecked
        $this->collection_of_answeres('AnswereUnchecked', 3);

        $response = $this->json('GET', '/api/answeres/checked');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'answere',
                            'score',
                            'created_at',
                            'user' => [
                                'id',
                                'email',
                                'phone',
                                'email_verified_at',
                                'first_name',
                                'family_name',
                                'age',
                                'gender',
                                'score',
                                'created_at'
                            ],
                            'challenge' => [
                                'id',
                                'sort_order',
                                'playfield' => [
                                    'id',
                                    'type',
                                    'short_code',
                                    'name'
                                ],
                                'game' => [
                                    'id',
                                    'type',
                                    'title',
                                    'content_text',
                                    'correct_answere',
                                    'points_min',
                                    'points_max',
                                    'created_at'
                                ]
                            ],
                            'media_submission' => [
                                '*' => [
                                    'def',
                                    'md',
                                    'sm',
                                    'thumb'
                                ]
                            ]
                        ]
                    ]
                 ]);
    }

    /**
     * @test
     */
    public function can_get_all_checked_answeres_paginated()
    {
        // Create 3 Checked
        $answeres_checkeds = $this->collection_of_answeres('AnswereChecked', 3);

        foreach($answeres_checkeds as $answeres_checked){
            $this->file_factory($answeres_checked, 'submission', ['chelsea']); // add 1 submission per answere
        }

        // Create 3 Unchecked
        $this->collection_of_answeres('AnswereUnchecked', 6);

        $response = $this->json('GET', '/api/answeres/checked/paginate/3');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'answere',
                            'score',
                            'created_at',
                            'user' => [
                                'id',
                                'email',
                                'phone',
                                'email_verified_at',
                                'first_name',
                                'family_name',
                                'age',
                                'gender',
                                'score',
                                'created_at'
                            ],
                            'challenge' => [
                                'id',
                                'sort_order',
                                'playfield' => [
                                    'id',
                                    'type',
                                    'short_code',
                                    'name'
                                ],
                                'game' => [
                                    'id',
                                    'type',
                                    'title',
                                    'content_text',
                                    'correct_answere',
                                    'points_min',
                                    'points_max',
                                    'created_at'
                                ]
                            ],
                            'media_submission' => [
                                '*' => [
                                    'def',
                                    'md',
                                    'sm',
                                    'thumb'
                                ]
                            ]
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
    public function gives_null_values_for_relationships_if_there_is_no_relational_data_CHECKED()
    {
        $answere = $this->create('AnswereChecked');

        $response = $this->json('GET', "/api/answeres/checked/$answere->id");

        $response->assertStatus(200)
                ->assertJsonFragment(['id' => $answere->id])
                ->assertExactJson([
                    'data' => [
                            'id' => $answere->id,
                            'answere' => $answere->answere,
                            'score' => $answere->score,
                            'created_at' => (string)$answere->created_at,
                            'user' => null,
                            'challenge' => null,
                            'media_submission' => null
                        ]
                ]);
    }

    /**
     * @test
     */
    public function gives_null_values_for_nested_gamen_and_playfield_relationships_in_challenge_relationship_if_there_is_no_relational_data_CHECKED()
    {

        $challenge = $this->create('Games\Challenge');

        $answere = $this->create('AnswereChecked', [
            'challenge_id' => $challenge->id
        ]);

        $this->file_factory($answere, 'submission', ['chelsea']);

        $response = $this->json('GET', "/api/answeres/checked/$answere->id");

        $response->assertStatus(200)
                ->assertJsonFragment(['id' => $answere->id])
                ->assertExactJson([
                    'data' => [
                            'id' => $answere->id,
                            'answere' => $answere->answere,
                            'score' => $answere->score,
                            'user' => null,
                            'created_at' => (string)$answere->created_at,
                            'challenge' => [
                                'id' => $challenge->id,
                                'sort_order' => $challenge->sort_order,
                                'created_at' => (string)$challenge->created_at,
                                'playfield' => null,
                                'game' => null
                            ],
                            'media_submission' => [
                                [
                                    'def' => $answere->getMedia('submission')[0]->getUrl(),
                                    'md' => $answere->getMedia('submission')[0]->getUrl('md'),
                                    'sm' => $answere->getMedia('submission')[0]->getUrl('sm'),
                                    'thumb' => $answere->getMedia('submission')[0]->getUrl('thumb')
                                ]
                            ]
                        ]
                ]);            
    }

    /**
     * @test
     */
    public function gives_null_values_for_relationships_if_there_is_no_relational_data_UNCHECKED()
    {
        $answere = $this->create('AnswereUnchecked');

        $response = $this->json('GET', "/api/answeres/unchecked/$answere->id");

        $response->assertStatus(200)
                ->assertJsonFragment(['id' => $answere->id])
                ->assertExactJson([
                    'data' => [
                            'id' => $answere->id,
                            'answere' => $answere->answere,
                            'score' => $answere->score,
                            'created_at' => (string)$answere->created_at,
                            'user' => null,
                            'challenge' => null,
                            'media_submission' => null
                        ]
                ]);
    }

        /**
     * @test
     */
    public function gives_null_values_for_nested_gamen_and_playfield_relationships_in_challenge_relationship_if_there_is_no_relational_data_UNCHECKED()
    {

        $challenge = $this->create('Games\Challenge');

        $answere = $this->create('AnswereChecked', [
            'challenge_id' => $challenge->id
        ]);

        $this->file_factory($answere, 'submission', ['chelsea']); // add 1 submission per answere


        $response = $this->json('GET', "/api/answeres/checked/$answere->id");

        $response->assertStatus(200)
                ->assertJsonFragment(['id' => $answere->id])
                ->assertExactJson([
                    'data' => [
                            'id' => $answere->id,
                            'answere' => $answere->answere,
                            'score' => $answere->score,
                            'created_at' => (string)$answere->created_at,
                            'user' => null,
                            'challenge' => [
                                'id' => $challenge->id,
                                'sort_order' => $challenge->sort_order,
                                'created_at' => (string)$challenge->created_at,
                                'playfield' => null,
                                'game' => null
                            ],
                            'media_submission' => [
                                [
                                    'def' => $answere->getMedia('submission')[0]->getUrl(),
                                    'md' => $answere->getMedia('submission')[0]->getUrl('md'),
                                    'sm' => $answere->getMedia('submission')[0]->getUrl('sm'),
                                    'thumb' => $answere->getMedia('submission')[0]->getUrl('thumb')
                                ]
                            ]
                        ]
                ]);
    }

    /**
     * @test
     */
    public function can_get_a_single_checked_answere_by_id()
    {

        $challenge = $this->create('Games\Challenge',
            [
                'game_type' => 'text_answere',
                'game_id' => $this->create('Games\GameTextAnswere', [], false)->id,
                'playfield_type' => 'city',
                'playfield_id' => $this->create('Playfields\City', [], false)->id
            ],
            false);
        $user = $this->create('User', [], false);

        $answere = $this->create('AnswereChecked', [
            'challenge_id' => $challenge->id,
            'user_id' => $user->id
        ], false);

        $this->file_factory($answere, 'submission', ['chelsea']); // add 1 submission per answere


        $response = $this->json('GET', "/api/answeres/checked/$answere->id");

        $response->assertStatus(200)
                ->assertJsonFragment(['id' => $answere->id])
                ->assertJsonStructure([
                    'data' => [
                            'id',
                            'answere',
                            'score',
                            'created_at',
                            'user' => [
                                'id',
                                'email',
                                'phone',
                                'email_verified_at',
                                'first_name',
                                'family_name',
                                'age',
                                'gender',
                                'score',
                                'created_at'
                            ],
                            'challenge' => [
                                'id',
                                'sort_order',
                                'playfield' => [
                                    'id',
                                    'type',
                                    'short_code',
                                    'name'
                                ],
                                'game' => [
                                    'id',
                                    'type',
                                    'title',
                                    'content_text',
                                    'correct_answere',
                                    'points_min',
                                    'points_max',
                                    'created_at'
                                ]
                            ],
                            'media_submission' => [
                                '*' => [
                                    'def',
                                    'md',
                                    'sm',
                                    'thumb'
                                ]
                            ]
                        ]
                ]);
    }

    /**
     * @test
     */
    public function can_get_a_single_unchecked_answere_by_id()
    {
        $challenge = $this->create('Games\Challenge',
            [
                'game_type' => 'text_answere',
                'game_id' => $this->create('Games\GameTextAnswere', [], false)->id,
                'playfield_type' => 'city',
                'playfield_id' => $this->create('Playfields\City', [], false)->id
            ],
            false);

        $user = $this->create('User', [], false);

        $answere = $this->create('AnswereUnchecked', [
            'challenge_id' => $challenge->id,
            'user_id' => $user->id
        ], false);

        $this->file_factory($answere, 'submission', ['chelsea']); // add 1 submission per answere

        $response = $this->json('GET', "/api/answeres/unchecked/$answere->id");

        $response->assertStatus(200)
        ->assertJsonFragment(['id' => $answere->id])
        ->assertJsonStructure([
            'data' => [
                    'id',
                    'answere',
                    'score',
                    'created_at',
                    'user' => [
                        'id',
                        'email',
                        'phone',
                        'email_verified_at',
                        'first_name',
                        'family_name',
                        'age',
                        'gender',
                        'score',
                        'created_at'
                    ],
                    'challenge' => [
                        'id',
                        'sort_order',
                        'playfield' => [
                            'id',
                            'type',
                            'short_code',
                            'name'
                        ],
                        'game' => [
                            'id',
                            'type',
                            'title',
                            'content_text',
                            'correct_answere',
                            'points_min',
                            'points_max',
                            'created_at'
                        ]
                    ],
                    'media_submission' => [
                        '*' => [
                            'def',
                            'md',
                            'sm',
                            'thumb'
                        ]
                    ]
                ]
        ]);
    }
}


trait Post
{

    // MEDIA COLLECTION FOR BOTH MODELS: submission

   /**
     * @test
     */
    public function can_create_a_checked_answere_with_valid_submission_media()
    {
        $challenge = $this->create('Games\Challenge', [
            'game_type' => 'text_answere',
            'game_id' => $this->create('Games\GameTextAnswere')->id,
            'playfield_type' => 'city',
            'playfield_id' => $this->create('Playfields\City')->id,
        ]);

        $body = [
            'challenge_id' => $challenge->id,
            'user_id' => $this->create('User')->id,
            'answere' => 'ajsdj huasf oiioe iewa saijsa.',
            'score' => 1200
        ];

        $files = [          
            'submission' => [
                UploadedFile::fake()->image('liverpool.jpg')            
            ]
        ];

        $res = $this->json('POST', '/api/answeres/checked', array_merge($body, $files));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
                    'answere',
                    'score',
                    'created_at',
                    'user' => [
                        'id',
                        'email',
                        'phone',
                        'email_verified_at',
                        'first_name',
                        'family_name',
                        'age',
                        'gender',
                        'score',
                        'created_at'
                    ],
                    'challenge' => [
                        'id',
                        'sort_order',
                        'created_at',
                        'playfield' => [
                            'id',
                            'type',
                            'short_code',
                            'name',
                            'created_at'
                        ],
                        'game' => [
                            'id',
                            'type',
                            'title',
                            'content_text',
                            'correct_answere',
                            'points_min',
                            'points_max',
                            'created_at'
                        ]
                    ],
                    'media_submission' => [
                        '*' => [
                            'def',
                            'md',
                            'sm',
                            'thumb'
                        ]
                    ]  
            ]
        ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('answere_checkeds', $body);

        // assert if the files are uploaded to storage
        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->media_submission)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
    }

    /**
     * @test
     */
    public function can_create_a_unchecked_answere_with_valid_submission_media()
    {
        $challenge = $this->create('Games\Challenge', [
            'game_type' => 'text_answere',
            'game_id' => $this->create('Games\GameTextAnswere')->id,
            'playfield_type' => 'city',
            'playfield_id' => $this->create('Playfields\City')->id,
        ]);

        $body = [
            'challenge_id' => $challenge->id,
            'user_id' => $this->create('User')->id,
            'answere' => 'ajsdj huasf oiioe iewa saijsa.',
            'score' => null
        ];
        $files = [          
            'submission' => [
                UploadedFile::fake()->image('liverpool.jpg')            
            ]
        ];

        $res = $this->json('POST', '/api/answeres/unchecked', array_merge($body, $files));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
                    'answere',
                    'score',
                    'created_at',
                    'user' => [
                        'id',
                        'email',
                        'phone',
                        'email_verified_at',
                        'first_name',
                        'family_name',
                        'age',
                        'gender',
                        'score',
                        'created_at'
                    ],
                    'challenge' => [
                        'id',
                        'sort_order',
                        'created_at',
                        'playfield' => [
                            'id',
                            'type',
                            'short_code',
                            'name',
                            'created_at'
                        ],
                        'game' => [
                            'id',
                            'type',
                            'title',
                            'content_text',
                            'correct_answere',
                            'points_min',
                            'points_max',
                            'created_at'
                        ]
                    ],
                    'media_submission' => [
                        '*' => [
                            'def',
                            'md',
                            'sm',
                            'thumb'
                        ]
                    ]  
            ]
        ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('answere_uncheckeds', $body);

        // assert if the files are uploaded to storage
        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->media_submission)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
    }

    /**
     * @test
     */
    public function can_create_a_checked_answere_without_submission_media()
    {
        $challenge = $this->create('Games\Challenge', [
            'game_type' => 'text_answere',
            'game_id' => $this->create('Games\GameTextAnswere')->id,
            'playfield_type' => 'city',
            'playfield_id' => $this->create('Playfields\City')->id,
        ]);

        $body = [
            'challenge_id' => $challenge->id,
            'user_id' => $this->create('User')->id,
            'answere' => 'ajsdj huasf oiioe iewa saijsa.',
            'score' => 15000
        ];

        $res = $this->json('POST', '/api/answeres/checked', $body);

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
                    'answere',
                    'score',
                    'created_at',
                    'user' => [
                        'id',
                        'email',
                        'phone',
                        'email_verified_at',
                        'first_name',
                        'family_name',
                        'age',
                        'gender',
                        'score',
                        'created_at'
                    ],
                    'challenge' => [
                        'id',
                        'sort_order',
                        'created_at',
                        'playfield' => [
                            'id',
                            'type',
                            'short_code',
                            'name',
                            'created_at'
                        ],
                        'game' => [
                            'id',
                            'type',
                            'title',
                            'content_text',
                            'correct_answere',
                            'points_min',
                            'points_max',
                            'created_at'
                        ]
                    ],
                    'media_submission' //null
            ]
        ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('answere_checkeds', $body);

    }

    /**
     * @test
     */
    public function can_create_a_unchecked_answere_without_submission_media()
    {
        $challenge = $this->create('Games\Challenge', [
            'game_type' => 'text_answere',
            'game_id' => $this->create('Games\GameTextAnswere')->id,
            'playfield_type' => 'city',
            'playfield_id' => $this->create('Playfields\City')->id,
        ]);

        $body = [
            'challenge_id' => $challenge->id,
            'user_id' => $this->create('User')->id,
            'answere' => 'ajsdj huasf oiioe iewa saijsa.',
            'score' => null
        ];

        $res = $this->json('POST', '/api/answeres/unchecked', $body);

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
                    'answere',
                    'score',
                    'created_at',
                    'user' => [
                        'id',
                        'email',
                        'phone',
                        'email_verified_at',
                        'first_name',
                        'family_name',
                        'age',
                        'gender',
                        'score',
                        'created_at'
                    ],
                    'challenge' => [
                        'id',
                        'sort_order',
                        'created_at',
                        'playfield' => [
                            'id',
                            'type',
                            'short_code',
                            'name',
                            'created_at'
                        ],
                        'game' => [
                            'id',
                            'type',
                            'title',
                            'content_text',
                            'correct_answere',
                            'points_min',
                            'points_max',
                            'created_at'
                        ]
                    ],
                    'media_submission' //null
            ]
        ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('answere_uncheckeds', $body);
    }

    /**
     * @test
     */
    public function respond_with_422_if_creating_a_checked_answere_with_non_existant_challenge_id()
    {

        $body = [
            'challenge_id' => -1,
            'user_id' => $this->create('User')->id,
            'answere' => 'ajsdj huasf oiioe iewa saijsa.',
            'score' => 15000
        ];

        $res = $this->json('POST', '/api/answeres/checked', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('answere_checkeds', $body);
    }

        /**
     * @test
     */
    public function respond_with_422_if_creating_a_checked_answere_with_non_existant_user_id()
    {
        $challenge = $this->create('Games\Challenge', [
            'game_type' => 'text_answere',
            'game_id' => $this->create('Games\GameTextAnswere')->id,
            'playfield_type' => 'city',
            'playfield_id' => $this->create('Playfields\City')->id,
        ]);

        $body = [
            'challenge_id' => $challenge->id,
            'user_id' => -1,
            'answere' => 'ajsdj huasf oiioe iewa saijsa.',
            'score' => 15000
        ];

        $res = $this->json('POST', '/api/answeres/checked', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('answere_checkeds', $body);
    }

        /**
     * @test
     */
    public function respond_with_422_if_creating_a_unchecked_answere_with_non_existant_challenge_id()
    {

        $body = [
            'challenge_id' => -1,
            'user_id' => $this->create('User')->id,
            'answere' => 'ajsdj huasf oiioe iewa saijsa.',
            'score' => null
        ];

        $res = $this->json('POST', '/api/answeres/unchecked', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('answere_uncheckeds', $body);
    }

        /**
     * @test
     */
    public function respond_with_422_if_creating_a_unchecked_answere_with_non_existant_user_id()
    {
        $challenge = $this->create('Games\Challenge', [
            'game_type' => 'text_answere',
            'game_id' => $this->create('Games\GameTextAnswere')->id,
            'playfield_type' => 'city',
            'playfield_id' => $this->create('Playfields\City')->id,
        ]);

        $body = [
            'challenge_id' => $challenge->id,
            'user_id' => -1,
            'answere' => 'ajsdj huasf oiioe iewa saijsa.',
            'score' => null
        ];

        $res = $this->json('POST', '/api/answeres/unchecked', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('answere_uncheckeds', $body);
    }

            /**
     * @test
     */
    public function create_checked_answere_will_respond_with_422_if_request_body_data_type_is_incorrect()
    {
        $challenge = $this->create('Games\Challenge', [
            'game_type' => 'text_answere',
            'game_id' => $this->create('Games\GameTextAnswere')->id,
            'playfield_type' => 'city',
            'playfield_id' => $this->create('Playfields\City')->id,
        ]);

        // 'answere' is of wrong data type
        $body = [
            'challenge_id' => $challenge->id,
            'user_id' => $this->create('User')->id,
            'answere' => 213435,
            'score' => 15000
        ];

        $res = $this->json('POST', '/api/answeres/checked', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('answere_checkeds', $body);
    }

                /**
     * @test
     */
    public function create_unchecked_answere_will_respond_with_422_if_request_body_data_type_is_incorrect()
    {
        $challenge = $this->create('Games\Challenge', [
            'game_type' => 'text_answere',
            'game_id' => $this->create('Games\GameTextAnswere')->id,
            'playfield_type' => 'city',
            'playfield_id' => $this->create('Playfields\City')->id,
        ]);

        // 'answere' is of wrong data type
        $body = [
            'challenge_id' => $challenge->id,
            'user_id' => $this->create('User')->id,
            'answere' => 213435,
            'score' => null
        ];

        $res = $this->json('POST', '/api/answeres/unchecked', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('answere_uncheckeds', $body);
    }

    /**
     * @test
     */
    public function create_checked_answere_will_respond_with_422_if_request_body_data_is_missing()
    {
        $challenge = $this->create('Games\Challenge', [
            'game_type' => 'text_answere',
            'game_id' => $this->create('Games\GameTextAnswere')->id,
            'playfield_type' => 'city',
            'playfield_id' => $this->create('Playfields\City')->id,
        ]);

        // 'answere' is of wrong data type
        $body = [
            'challenge_id' => $challenge->id,
            'user_id' => $this->create('User')->id,
            'score' => 15000
        ];

        $res = $this->json('POST', '/api/answeres/checked', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('answere_checkeds', $body);
    }


    /**
     * @test
     */
    public function create_unchecked_answere_will_respond_with_422_if_request_body_data_is_missing()
    {
        $challenge = $this->create('Games\Challenge', [
            'game_type' => 'text_answere',
            'game_id' => $this->create('Games\GameTextAnswere')->id,
            'playfield_type' => 'city',
            'playfield_id' => $this->create('Playfields\City')->id,
        ]);

        // 'answere' is missing
        $body = [
            'challenge_id' => $challenge->id,
            'user_id' => $this->create('User')->id,
            'score' => null
        ];

        $res = $this->json('POST', '/api/answeres/unchecked', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('answere_uncheckeds', $body);
    }

        /**
     * @test
     */
    public function create_checked_answere_will_respond_with_422_if_request_file_is_of_wrong_type()
    {
        $challenge = $this->create('Games\Challenge', [
            'game_type' => 'text_answere',
            'game_id' => $this->create('Games\GameTextAnswere')->id,
            'playfield_type' => 'city',
            'playfield_id' => $this->create('Playfields\City')->id,
        ]);

        // 'answere' is missing
        $body = [
            'challenge_id' => $challenge->id,
            'user_id' => $this->create('User')->id,
            'answere' => 'sadffasfaf adsf afds.',
            'score' => 15000
        ];

        $files = [          
            'submission' => [
                UploadedFile::fake()->image('liverpool.csv')            
            ]
        ];

        $res = $this->json('POST', '/api/answeres/checked', array_merge($body, $files));

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('answere_checkeds', $body);
    }

            /**
     * @test
     */
    public function create_unchecked_answere_will_respond_with_422_if_request_file_is_of_wrong_type()
    {
        $challenge = $this->create('Games\Challenge', [
            'game_type' => 'text_answere',
            'game_id' => $this->create('Games\GameTextAnswere')->id,
            'playfield_type' => 'city',
            'playfield_id' => $this->create('Playfields\City')->id,
        ]);

        // 'answere' is missing
        $body = [
            'challenge_id' => $challenge->id,
            'user_id' => $this->create('User')->id,
            'answere' => 'sadffasfaf adsf afds.',
            'score' => null
        ];

        $files = [          
            'submission' => [
                UploadedFile::fake()->image('liverpool.csv')            
            ]
        ];

        $res = $this->json('POST', '/api/answeres/unchecked', array_merge($body, $files));

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('answere_uncheckeds', $body);
    }


}

trait Put
{

    // Submission media collection
    // Relational keys for User
    

    /**
     * @test
     */
    public function will_fail_with_a_404_if_the_checked_answere_we_want_to_update_is_not_found()
    {
        $res = $this->json('PUT', 'api/answeres/checked/-1');
        $res->assertStatus(404);
    }

       /**
     * @test
     */
    public function will_fail_with_a_404_if_the_unchecked_answere_we_want_to_update_is_not_found()
    {
        $res = $this->json('PUT', 'api/answeres/unchecked/-1');
        $res->assertStatus(404);
    }

    // $challenge = $this->create('Games\Challenge', [
    //     'game_type' => 'text_answere',
    //     'game_id' => $this->create('Games\GameTextAnswere')->id,
    //     'playfield_type' => 'city',
    //     'playfield_id' => $this->create('Playfields\City')->id,
    // ]);

    // // 'answere' is missing
    // $body = [
    //     'challenge_id' => $challenge->id,
    //     'user_id' => $this->create('User')->id,
    //     'answere' => 'sadffasfaf adsf afds.',
    //     'score' => null
    // ];


    
    /**
     * @test
     */
    public function can_add_a_submission_media_image_to_end_of_submission_collection_of_checked_answere()
    {

        // 'answere' is missing
        $old_values = [
            'challenge_id' => $this->create('Games\Challenge', [
                'game_type' => 'text_answere',
                'game_id' => $this->create('Games\GameTextAnswere')->id,
                'playfield_type' => 'city',
                'playfield_id' => $this->create('Playfields\City')->id,
            ])->id,
            'user_id' => $this->create('User')->id,
            'answere' => 'sadffasfaf adsf afds.',
            'score' => 25000
        ];

        $old_checked_answere = $this->create('AnswereChecked', $old_values);
        $this->file_factory($old_checked_answere, 'submission', ['submission1', 'submission2']);
        
        $files = [
            'submission' => [
                UploadedFile::fake()->image('submission3.jpg'),
                UploadedFile::fake()->image('submission4.jpg'),
            ]
        ];

        // When
        $res = $this->json('PUT','api/answeres/checked/'.$old_checked_answere->id, $files);

        // Then
        $res->assertStatus(200)
                    ->assertJsonCount(4, 'data.media_submission'); // assert that 2 images have been added to submission

        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->media_submission)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
    }

        /**
     * @test
     */
    public function can_add_a_submission_media_image_to_end_of_submission_collection_of_UNchecked_answere()
    {

        // 'answere' is missing
        $old_values = [
            'challenge_id' => $this->create('Games\Challenge', [
                'game_type' => 'text_answere',
                'game_id' => $this->create('Games\GameTextAnswere')->id,
                'playfield_type' => 'city',
                'playfield_id' => $this->create('Playfields\City')->id,
            ])->id,
            'user_id' => $this->create('User')->id,
            'answere' => 'sadffasfaf adsf afds.',
            'score' => null
        ];

        $old_unchecked_answere = $this->create('AnswereUnchecked', $old_values);
        $this->file_factory($old_unchecked_answere, 'submission', ['submission1', 'submission2']);
        
        $files = [
            'submission' => [
                UploadedFile::fake()->image('submission3.jpg'),
                UploadedFile::fake()->image('submission4.jpg'),
            ]
        ];

        // When
        $res = $this->json('PUT','api/answeres/unchecked/'.$old_unchecked_answere->id, $files);

        // Then
        $res->assertStatus(200)
                    ->assertJsonCount(4, 'data.media_submission'); // assert that 2 images have been added to submission

        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->media_submission)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
    }

    /**
     * @test
     */
    public function can_update_unchecked_answere_fully_on_each_model_attribute()
    {
        // Given
        $old_values = [
            'answere' => 'sadffasfaf adsf afds.',
            'score' => null
        ];

        $old_relations = [
            'challenge_id' => $this->create('Games\Challenge', [
                'game_type' => 'text_answere',
                'game_id' => $this->create('Games\GameTextAnswere')->id,
                'playfield_type' => 'city',
                'playfield_id' => $this->create('Playfields\City')->id,
            ])->id,
            'user_id' => $this->create('User')->id,
        ];

        $old_answere = $this->create('AnswereUnchecked', array_merge($old_values, $old_relations));

        // update every attribute
        $new_values = [
            'answere' => 'sadffasfaf adsf afds.',
            'score' => null
        ];

        $new_relations = [
            'challenge_id' => $this->create('Games\Challenge', [
                'game_type' => 'text_answere',
                'game_id' => $this->create('Games\GameTextAnswere')->id,
                'playfield_type' => 'city',
                'playfield_id' => $this->create('Playfields\City')->id,
            ])->id,
            'user_id' => $this->create('User')->id,
        ];

        // When
        $response = $this->json('PUT','api/answeres/unchecked/'.$old_answere->id, array_merge($new_values, $new_relations));

        // Then
        $response->assertStatus(200)
                    ->assertJsonFragment($new_values);
                    
        $this->assertDatabaseHas('answere_uncheckeds', $new_values);
        $this->assertDatabaseMissing('cities', $old_values);
            
    }

        /**
     * @test
     */
    public function can_update_checked_answere_fully_on_each_model_attribute()
    {
        // Given
        $old_values = [
            'answere' => 'sadffasfaf adsf afds.',
            'score' => 35000
        ];

        $old_relations = [
            'challenge_id' => $this->create('Games\Challenge', [
                'game_type' => 'text_answere',
                'game_id' => $this->create('Games\GameTextAnswere')->id,
                'playfield_type' => 'city',
                'playfield_id' => $this->create('Playfields\City')->id,
            ])->id,
            'user_id' => $this->create('User')->id
        ];

        $old_answere = $this->create('AnswereChecked', array_merge($old_values, $old_relations));

        // update every attribute
        $new_values = [
            'answere' => 'aaaaaaaa',
            'score' => 000001
        ];

        $new_relations = [
            'challenge_id' => $this->create('Games\Challenge', [
                'game_type' => 'text_answere',
                'game_id' => $this->create('Games\GameTextAnswere')->id,
                'playfield_type' => 'city',
                'playfield_id' => $this->create('Playfields\City')->id,
            ])->id,
            'user_id' => $this->create('User')->id,
        ];

        // When
        $response = $this->json('PUT','api/answeres/checked/'.$old_answere->id, array_merge($new_values, $new_relations));

        // Then
        $response->assertStatus(200)
                    ->assertJsonFragment($new_values);
                    
        $this->assertDatabaseHas('answere_checkeds', $new_values);
        $this->assertDatabaseMissing('answere_checkeds', $old_values);
            
    }
   
    /**
     * @test
     */
    public function can_update_answere_unchecked_on_a_couple_of_model_attributes()
    {
        // Given
        $old_values = [
            'challenge_id' => $this->create('Games\Challenge', [
                'game_type' => 'text_answere',
                'game_id' => $this->create('Games\GameTextAnswere')->id,
                'playfield_type' => 'city',
                'playfield_id' => $this->create('Playfields\City')->id,
            ])->id,
            'user_id' => $this->create('User')->id
        ];

        $old_values_to_remain_after_update = [
            'answere' => 'sadffasfaf adsf afds.',
            'score' => null
        ];

        $old_answere = $this->create('AnswereUnchecked', array_merge($old_values, $old_values_to_remain_after_update));

        // update every attribute
        $new_values = [
            'challenge_id' => $this->create('Games\Challenge', [
                'game_type' => 'text_answere',
                'game_id' => $this->create('Games\GameTextAnswere')->id,
                'playfield_type' => 'city',
                'playfield_id' => $this->create('Playfields\City')->id,
            ])->id,
            'user_id' => $this->create('User')->id
        ];

        // When
        $response = $this->json('PUT','api/answeres/unchecked/'.$old_answere->id, $new_values);

        // Then
        $response->assertStatus(200)
                 ->assertJsonFragment($old_values_to_remain_after_update);
                    
        $this->assertDatabaseHas('answere_uncheckeds', array_merge($new_values, $old_values_to_remain_after_update));
        $this->assertDatabaseMissing('answere_uncheckeds', $old_values);

    }


    /**
     * @test
     */
    public function will_fail_with_422_when_relational_challenge_does_not_exist_CHECKED_ANSWERE()
    {
                // Given
                $old_values = [
                    'challenge_id' => $this->create('Games\Challenge', [
                        'game_type' => 'text_answere',
                        'game_id' => $this->create('Games\GameTextAnswere')->id,
                        'playfield_type' => 'city',
                        'playfield_id' => $this->create('Playfields\City')->id,
                    ])->id,
                    'user_id' => $this->create('User')->id,
                    'answere' => 'sadffasfaf adsf afds.',
                    'score' => 35000
                ];
        
                $old_answere = $this->create('AnswereChecked', $old_values);
        
                // update relational challenge does not exist in database
                $new_values = [
                    'challenge_id' => -1
                ];
        
                // When
                $response = $this->json('PUT','api/answeres/checked/'.$old_answere->id, $new_values);
        
                // Then
                $response->assertStatus(422);
                            
                $this->assertDatabaseHas('answere_checkeds', $old_values);
                $this->assertDatabaseMissing('answere_checkeds', $new_values);
    }

    /**
     * @test
     */
    public function will_fail_with_422_when_relational_challenge_does_not_exist_UNCHECKED_ANSWERE()
    {
                // Given
                $old_values = [
                    'challenge_id' => $this->create('Games\Challenge', [
                        'game_type' => 'text_answere',
                        'game_id' => $this->create('Games\GameTextAnswere')->id,
                        'playfield_type' => 'city',
                        'playfield_id' => $this->create('Playfields\City')->id,
                    ])->id,
                    'user_id' => $this->create('User')->id,
                    'answere' => 'sadffasfaf adsf afds.',
                    'score' => null
                ];
        
                $old_answere = $this->create('AnswereUnchecked', $old_values);
        
                // update relational challenge does not exist in database
                $new_values = [
                    'challenge_id' => -1
                ];
        
                // When
                $response = $this->json('PUT','api/answeres/unchecked/'.$old_answere->id, $new_values);
        
                // Then
                $response->assertStatus(422);
                            
                $this->assertDatabaseHas('answere_uncheckeds', $old_values);
                $this->assertDatabaseMissing('answere_uncheckeds', $new_values);
    }


    /**
     * @test
     */
    public function will_fail_with_422_when_relational_user_does_not_exist_CHECKED_ANSWERE()
    {
                // Given
                $old_values = [
                    'challenge_id' => $this->create('Games\Challenge', [
                        'game_type' => 'text_answere',
                        'game_id' => $this->create('Games\GameTextAnswere')->id,
                        'playfield_type' => 'city',
                        'playfield_id' => $this->create('Playfields\City')->id,
                    ])->id,
                    'user_id' => $this->create('User')->id,
                    'answere' => 'sadffasfaf adsf afds.',
                    'score' => 35000
                ];
        
                $old_answere = $this->create('AnswereChecked', $old_values);
        
                // update relational user does not exist in database
                $new_values = [
                    'user_id' => -1
                ];
        
                // When
                $response = $this->json('PUT','api/answeres/checked/'.$old_answere->id, $new_values);
        
                // Then
                $response->assertStatus(422);
                            
                $this->assertDatabaseHas('answere_checkeds', $old_values);
                $this->assertDatabaseMissing('answere_checkeds', $new_values);
    }


    /**
     * @test
     */
    public function will_fail_with_422_when_relational_user_does_not_exist_UNCHECKED_ANSWERE()
    {
                // Given
                $old_values = [
                    'challenge_id' => $this->create('Games\Challenge', [
                        'game_type' => 'text_answere',
                        'game_id' => $this->create('Games\GameTextAnswere')->id,
                        'playfield_type' => 'city',
                        'playfield_id' => $this->create('Playfields\City')->id,
                    ])->id,
                    'user_id' => $this->create('User')->id,
                    'answere' => 'sadffasfaf adsf afds.',
                    'score' => null
                ];
        
                $old_answere = $this->create('AnswereUnchecked', $old_values);
        
                // update relational user does not exist in database
                $new_values = [
                    'user_id' => -1
                ];
        
                // When
                $response = $this->json('PUT','api/answeres/unchecked/'.$old_answere->id, $new_values);
        
                // Then
                $response->assertStatus(422);
                            
                $this->assertDatabaseHas('answere_uncheckeds', $old_values);
                $this->assertDatabaseMissing('answere_uncheckeds', $new_values);
    }


    /**
     * @test
     */
    public function will_fail_with_error_422_when_body_data_is_of_wrong_type_ANSWERE_CHECKED()
    {
        // Given
        $old_values = [
            'challenge_id' => $this->create('Games\Challenge', [
                'game_type' => 'text_answere',
                'game_id' => $this->create('Games\GameTextAnswere')->id,
                'playfield_type' => 'city',
                'playfield_id' => $this->create('Playfields\City')->id,
            ])->id,
            'user_id' => $this->create('User')->id,
            'answere' => 'sadffasfaf adsf afds.',
            'score' => 35000
        ];

        $old_answere = $this->create('AnswereChecked', $old_values);

        // 'answere' is of wrong type
        $new_values = [
            'challenge_id' => $this->create('Games\Challenge', [
                'game_type' => 'text_answere',
                'game_id' => $this->create('Games\GameTextAnswere')->id,
                'playfield_type' => 'city',
                'playfield_id' => $this->create('Playfields\City')->id,
            ])->id,
            'user_id' => $this->create('User')->id,
            'answere' => 0000001,
            'score' => 000001
        ];

        // When
        $response = $this->json('PUT','api/answeres/checked/'.$old_answere->id, $new_values);

        // Then
        $response->assertStatus(422);
                    
        $this->assertDatabaseHas('answere_checkeds', $old_values);
        $this->assertDatabaseMissing('answere_checkeds', $new_values);
            

    }

    /**
     * @test
     */
    public function will_fail_with_error_422_when_body_data_is_of_wrong_type_ANSWERE_UNCHECKED()
    {
        // Given
        $old_values = [
            'challenge_id' => $this->create('Games\Challenge', [
                'game_type' => 'text_answere',
                'game_id' => $this->create('Games\GameTextAnswere')->id,
                'playfield_type' => 'city',
                'playfield_id' => $this->create('Playfields\City')->id,
            ])->id,
            'user_id' => $this->create('User')->id,
            'answere' => 'sadffasfaf adsf afds.',
            'score' => null
        ];

        $old_answere = $this->create('AnswereUnchecked', $old_values);

        // 'answere' is of wrong type
        $new_values = [
            'challenge_id' => $this->create('Games\Challenge', [
                'game_type' => 'text_answere',
                'game_id' => $this->create('Games\GameTextAnswere')->id,
                'playfield_type' => 'city',
                'playfield_id' => $this->create('Playfields\City')->id,
            ])->id,
            'user_id' => $this->create('User')->id,
            'answere' => 0000001,
            'score' => null
        ];

        // When
        $response = $this->json('PUT','api/answeres/unchecked/'.$old_answere->id, $new_values);

        // Then
        $response->assertStatus(422);
                    
        $this->assertDatabaseHas('answere_uncheckeds', $old_values);
        $this->assertDatabaseMissing('answere_uncheckeds', $new_values);
            

    }
}

trait Delete
{
    //  /**
    //  * @test
    //  */
    // public function will_fail_with_a_404_if_the_answere_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/answeres/-1');
    //     $res->assertStatus(404);
    // }

    // /**
    //  * @test
    //  */
    // public function can_delete_a_answere()
    // {
    //     // Given
    //     // first create a answere in the database to delete
    //     $answere = $this->create('Answere');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/answeres/'.$answere->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $answere is deleted from database
    //     $this->assertDatabaseMissing('answeres', ['id' => $answere->id]);
    // }
}