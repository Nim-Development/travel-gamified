<?php 

namespace Tests\Feature\Http\Controllers\Admin\Games\ChallengeController;

trait Get
{

    /**
     * @test
     */
    public function will_fail_with_a_404_if_challenge_is_not_found()
    {
        $res = $this->json('GET', 'api/challenges/-1');
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_all_challenges_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/challenges');
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_challenges_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/challenges/paginate/3');
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function relationship_is_null_if_there_is_no_relationship()
    {
        // create challenge without creating any relationships
        $challenge = $this->create('Games\Challenge');

        $response = $this->json('GET', '/api/challenges/'.$challenge->id);

        $response->assertStatus(200)
                ->assertExactJson([
                'data' => [
                    'id' => $challenge->id,
                    'sort_order' => $challenge->sort_order,
                    'playfield' => null, // should be null because there is no relationship
                    'game' => null, // should be null because there is no relationship
                    'created_at' => (string)$challenge->created_at
                ]
            ]);
    }

    /**
     * @test
     */
    public function can_return_a_challenge_with_game_type_OFF_multiple_choice()
    {

        $playfield = $this->create('Playfields\City', [], false);

        $game = $this->create('Games\GameMultipleChoice', [], false);

        $challenge = $this->create('Games\Challenge', [
            'playfield_type' => 'city',
            'playfield_id' => $playfield->id,
            'game_type' => 'multiple_choice',
            'game_id' => $game->id
        ]);

        $response = $this->json('GET', '/api/challenges/'.$challenge->id);

        // assert if we get the same object id from our API
        //$this->assertSame($challenge->id, $response->getData()->data->id);

        $response->assertStatus(200)
                ->assertJsonStructure([

                        'data' => [
                            'id',
                            'sort_order',
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
                                'content_media',
                                'content_text',
                                'correct_answere',
                                'points_min',
                                'points_max',
                                'created_at'
                            ],
                            'created_at'
                    ]

                ])
                ->assertExactJson([
                    'data' => [
                        'id' => $challenge->id,
                        'sort_order' => $challenge->sort_order,
                        'playfield' => [
                            'id' => $playfield->id,
                            'type' => 'city',
                            'short_code' => $playfield->short_code,
                            'name' => $playfield->name,
                            'created_at' => (string)$playfield->created_at
                        ],
                        'game' => [
                            'id' => $game->id,
                            'type' => 'multiple_choice',
                            'title' => $game->title,
                            'content_media' => $game->content_media,
                            'content_text' => $game->content_text,
                            'correct_answere' => $game->correct_answere,
                            'points_min' => $game->points_min,
                            'points_max' => $game->points_max,
                            'created_at' => (string)$game->created_at
                        ],
                        'created_at' => (string)$challenge->created_at
                    ]
                ]
            );


            // {"data":{
            //     "created_at":"2019-12-15 13:49:48",
            //     "game":[
            //         {"content_media":"https:\/\/lorempixel.com\/640\/640\/?82031","content_text":"Omnis ut ut vitae reprehenderit est alias qui quis perspiciatis quod perspiciatis quis nihil id et id nisi deserunt placeat quia qui quaerat neque quod eum ut.","correct_answere":"Ipsa aspernatur voluptatem et consequatur dolor dicta.","created_at":"2019-12-15 13:49:48","id":1,"points_max":"35000","points_min":"0","title":"Glenda Collins","type":"multiple_choice"}],
            //     "id":1,
            //     "playfield":
            //         {"created_at":"2019-12-15 13:49:48","id":1,"name":"Madison Kutch","short_code":"Rodriguezmouth","type":"city"},
            //     "sort_order":"1"}}
    }

    /**
     * @test
     */
    public function can_return_a_challenge_with_game_type_OFF_text_answere()
    {
        $playfield = $this->create('Playfields\City', [], false);
        $game = $this->create('Games\GameTextAnswere', [], false);

        $challenge = $this->create('Games\Challenge', [
            'playfield_type' => 'city',
            'playfield_id' => $playfield->id,
            'game_type' => 'text_answere',
            'game_id' => $game->id
        ]);

        $response = $this->json('GET', '/api/challenges/'.$challenge->id);

        $this->assertSame($challenge->id, $response->getData()->data->id);
        $response->assertStatus(200)
                ->assertExactJson([
                'data' => [
                    'id' => $challenge->id,
                    'sort_order' => $challenge->sort_order,
                    'playfield' => [
                        'id' => $playfield->id,
                        'type' => 'city',
                        'short_code' => $playfield->short_code,
                        'name' => $playfield->name,
                        'created_at' => (string)$playfield->created_at
                    ],
                    'game' => [
                        'id' => $game->id,
                        'type' => 'text_answere',
                        'title' => $game->title,
                        'content_media' => $game->content_media,
                        'content_text' => $game->content_text,
                        'correct_answere' => $game->correct_answere,
                        'points_min' => $game->points_min,
                        'points_max' => $game->points_max,
                        'created_at' => (string)$game->created_at
                    ],
                    'created_at' => (string)$challenge->created_at
                ]
            ]);
    }

    /**
     * @test
     */
    public function can_return_a_challenge_with_game_type_OFF_media_upload()
    {
        $playfield = $this->create('Playfields\City', [], false);
        $game = $this->create('Games\GameMediaUpload', [], false);

        $challenge = $this->create('Games\Challenge', [
            'playfield_type' => 'city',
            'playfield_id' => $playfield->id,
            'game_type' => 'media_upload',
            'game_id' => $game->id
        ]);

        $response = $this->json('GET', '/api/challenges/'.$challenge->id);

        $this->assertSame($challenge->id, $response->getData()->data->id);
        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        'id',
                        'sort_order',
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
                            'content_media',
                            'content_text',
                            'media_type',
                            'correct_answere',
                            'points_min',
                            'points_max',
                            'created_at'
                        ],
                        'created_at'
                    ]
                ])->assertExactJson([
                    'data' => [
                        'id' => $challenge->id,
                        'sort_order' => $challenge->sort_order,
                        'playfield' => [
                            'id' => $playfield->id,
                            'type' => 'city',
                            'short_code' => $playfield->short_code,
                            'name' => $playfield->name,
                            'created_at' => (string)$playfield->created_at
                        ],
                        'game' => [
                            'id' => $game->id,
                            'type' => 'media_upload',
                            'title' => $game->title,
                            'content_media' => $game->content_media,
                            'content_text' => $game->content_text,
                            'media_type' => $game->media_type,
                            'correct_answere' => $game->correct_answere,
                            'points_min' => $game->points_min,
                            'points_max' => $game->points_max,
                            'created_at' => (string)$game->created_at
                        ],
                        'created_at' => (string)$challenge->created_at
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_all_challenges()
    {
        // make 6 challenges
        $this->collection_of_challenges('city', 'text_answere', 6);

        $response = $this->json('GET', '/api/challenges');

        $response->assertStatus(200)
                ->assertJsonCount(6, 'data')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'sort_order',
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
                                'content_media',
                                'content_text',
                                'correct_answere',
                                'points_min',
                                'points_max',
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
    public function can_return_a_collection_of_all_challenges_paginated()
    {
        // make 6 challenges
        $this->collection_of_challenges('city', 'text_answere', 6);

        $response = $this->json('GET', '/api/challenges/paginate/3');

        $response->assertStatus(200)
                ->assertJsonCount(3, 'data')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'sort_order',
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
                                'content_media',
                                'content_text',
                                'correct_answere',
                                'points_min',
                                'points_max',
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
    public function can_get_all_challenges_with_playfield_type_of_route()
    {
        // make 3 challenges with playfield route
        $this->collection_of_challenges('route', 'text_answere', 3);

        // make 3 challenges with playfield city
        $this->collection_of_challenges('city', 'text_answere', 3);

        $response = $this->json('GET', "/api/challenges/playfield/route");

        $this->assert_if_all_objects_have_same_type_in_specified_relation($response, 'playfield', 'route');
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                            'id',
                            'sort_order',
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
                            ],
                            'created_at'
                        ]
                     ]
                 ]);

    }
    /**
     * @test
     */
    public function can_get_all_challenges_with_playfield_type_of_route_paginated()
    {
        // make 3 challenges with playfield route
        $this->collection_of_challenges('route', 'text_answere', 6);

        // make 3 challenges with playfield city
        $this->collection_of_challenges('city', 'text_answere', 3);

        $response = $this->json('GET', "/api/challenges/playfield/route/paginate/3");

        $this->assert_if_all_objects_have_same_type_in_specified_relation($response, 'playfield', 'route');
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                            'id',
                            'sort_order',
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
    public function can_get_all_challenges_with_playfield_type_of_transit()
    {
        // make 3 challenges with playfield transit
        $this->collection_of_challenges('transit', 'text_answere', 3);

        // make 3 challenges with playfield city
        $this->collection_of_challenges('city', 'text_answere', 3);

        $response = $this->json('GET', "/api/challenges/playfield/transit");

        $this->assert_if_all_objects_have_same_type_in_specified_relation($response, 'playfield', 'transit');
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                            'id',
                            'sort_order',
                            'playfield' => [
                                'id',
                                'type',
                                'name',
                                'from',
                                'to',
                                'created_at'
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
                            ],
                            'created_at'
                        ]
                     ]
                 ]);
    }
    /**
     * @test
     */
    public function can_get_all_challenges_with_playfield_type_of_transit_paginated()
    {
        // make 3 challenges with playfield transit
        $this->collection_of_challenges('transit', 'text_answere', 6);

        // make 3 challenges with playfield city
        $this->collection_of_challenges('city', 'text_answere', 3);

        $response = $this->json('GET', "/api/challenges/playfield/transit/paginate/3");

        $this->assert_if_all_objects_have_same_type_in_specified_relation($response, 'playfield', 'transit');
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                            'id',
                            'sort_order',
                            'playfield' => [
                                'id',
                                'type',
                                'name',
                                'from',
                                'to',
                                'created_at'
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
    public function can_get_all_challenges_with_playfield_type_of_city()
    {
        // make 3 challenges with playfield transit
        $this->collection_of_challenges('city', 'text_answere', 3);

        // make 3 challenges with playfield city
        $this->collection_of_challenges('transit', 'text_answere', 3);

        $response = $this->json('GET', "/api/challenges/playfield/city");

        $this->assert_if_all_objects_have_same_type_in_specified_relation($response, 'playfield', 'city');
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                            'id',
                            'sort_order',
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
                                'content_media',
                                'content_text',
                                'correct_answere',
                                'points_min',
                                'points_max',
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
    public function can_get_all_challenges_with_playfield_type_of_city_paginated()
    {
        // make 3 challenges with playfield city
        $this->collection_of_challenges('city', 'text_answere', 6);

        // make 3 challenges with playfield transit
        $this->collection_of_challenges('transit', 'text_answere', 3);

        $response = $this->json('GET', "/api/challenges/playfield/city/paginate/3");

        $this->assert_if_all_objects_have_same_type_in_specified_relation($response, 'playfield', 'city');
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                            'id',
                            'sort_order',
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
                                'content_media',
                                'content_text',
                                'correct_answere',
                                'points_min',
                                'points_max',
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
    public function can_get_all_challenges_with_game_type_of_multiple_choice()
    {
        // make 3 challenges with requested
        $this->collection_of_challenges('city', 'multiple_choice', 3);

        // make 3 challenge with different game
        $this->collection_of_challenges('city', 'text_answere', 3);

        $response = $this->json('GET', "/api/challenges/game/multiple_choice");

        // functions make assertions to check if all collection values have game type multiple_choice
        $this->assert_if_all_objects_have_same_type_in_specified_relation($response, 'game', 'multiple_choice');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                            'id',
                            'sort_order',
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
                                'content_media',
                                'content_text',
                                'correct_answere',
                                'points_min',
                                'points_max',
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
    public function can_get_all_challenges_with_game_type_of_multiple_choice_paginated()
    {
        // make 3 challenges with requested
        $this->collection_of_challenges('city', 'multiple_choice', 6);

        // make 3 challenge with different game
        $this->collection_of_challenges('city', 'text_answere', 3);

        $response = $this->json('GET', "/api/challenges/game/multiple_choice/paginate/3");

        $this->assert_if_all_objects_have_same_type_in_specified_relation($response, 'game', 'multiple_choice');
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                            'id',
                            'sort_order',
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
                                'content_media',
                                'content_text',
                                'correct_answere',
                                'points_min',
                                'points_max',
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
    public function can_get_all_challenges_with_game_type_of_text_answere()
    {
        // make 3 challenges with requested
        $this->collection_of_challenges('city', 'text_answere', 3);

        // make 3 challenge with different game
        $this->collection_of_challenges('city', 'multiple_choice', 3);

        $response = $this->json('GET', "/api/challenges/game/text_answere");

        $this->assert_if_all_objects_have_same_type_in_specified_relation($response, 'game', 'text_answere');
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                            'id',
                            'sort_order',
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
                                'content_media',
                                'content_text',
                                'correct_answere',
                                'points_min',
                                'points_max',
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
    public function can_get_all_challenges_with_game_type_of_text_answere_paginated()
    {
        // make 3 challenges with requested
        $this->collection_of_challenges('city', 'text_answere', 6);

        // make 3 challenge with different game
        $this->collection_of_challenges('city', 'multiple_choice', 3);

        $response = $this->json('GET', "/api/challenges/game/text_answere/paginate/3");

        $this->assert_if_all_objects_have_same_type_in_specified_relation($response, 'game', 'text_answere');
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                            'id',
                            'sort_order',
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
                                'content_media',
                                'content_text',
                                'correct_answere',
                                'points_min',
                                'points_max',
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
    public function can_get_all_challenges_with_game_type_of_media_upload()
    {
        // make 3 challenges with requested
        $this->collection_of_challenges('city', 'media_upload', 3);

        // make 3 challenge with different game
        $this->collection_of_challenges('city', 'multiple_choice', 3);

        $response = $this->json('GET', "/api/challenges/game/media_upload");

        $this->assert_if_all_objects_have_same_type_in_specified_relation($response, 'game', 'media_upload');
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                            'id',
                            'sort_order',
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
                                'content_media',
                                'content_text',
                                'media_type',
                                'correct_answere',
                                'points_min',
                                'points_max',
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
    public function can_get_all_challenges_with_game_type_of_media_upload_paginated()
    {
        // make 3 challenges with requested
        $this->collection_of_challenges('city', 'media_upload', 6);

        // make 3 challenge with different game
        $this->collection_of_challenges('city', 'multiple_choice', 3);

        $response = $this->json('GET', "/api/challenges/game/media_upload/paginate/3");

        $this->assert_if_all_objects_have_same_type_in_specified_relation($response, 'game', 'media_upload');
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                            'id',
                            'sort_order',
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
                                'content_media',
                                'content_text',
                                'media_type',
                                'correct_answere',
                                'points_min',
                                'points_max',
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




        /**
         * Add functionality for getting checked and unchecked answeres relations.
         */
    }
}


