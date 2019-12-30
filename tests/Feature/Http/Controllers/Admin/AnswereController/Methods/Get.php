<?php 

namespace Tests\Feature\Http\Controllers\Admin\AnswereController;

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
        $this->collection_of_answeres('AnswereUnchecked', 3);

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
                                    'content_media',
                                    'content_text',
                                    'correct_answere',
                                    'points_min',
                                    'points_max',
                                    'created_at'
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
        $this->collection_of_answeres('AnswereUnchecked', 6);

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
                                    'content_media',
                                    'content_text',
                                    'correct_answere',
                                    'points_min',
                                    'points_max',
                                    'created_at'
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
        $this->collection_of_answeres('AnswereChecked', 3);

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
                                    'content_media',
                                    'content_text',
                                    'correct_answere',
                                    'points_min',
                                    'points_max',
                                    'created_at'
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
        $this->collection_of_answeres('AnswereChecked', 3);

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
                                    'content_media',
                                    'content_text',
                                    'correct_answere',
                                    'points_min',
                                    'points_max',
                                    'created_at'
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
                            'challenge' => null
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
                            'challenge' => null
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
                                    'content_media',
                                    'content_text',
                                    'correct_answere',
                                    'points_min',
                                    'points_max',
                                    'created_at'
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
                            'content_media',
                            'content_text',
                            'correct_answere',
                            'points_min',
                            'points_max',
                            'created_at'
                        ]
                    ]
                ]
        ]);
    }
}


