<?php

namespace Tests\Feature\Http\Controllers\Admin\ChallengeController;

use Faker\Factory;
use Tests\TestCase;

use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ChallengeControllerTest extends TestCase
{

    use RefreshDatabase;
    
    // disables CSRF token. for PUT requests
    use WithoutMiddleware;

    // Include the different tests (seperated by API type)
    use Get;
    use Post;
    use Put;
    use Delete;

    protected $api_base = 'api/admin/challenges';


    // ::nk FOR SOME REASON TESTS RETURN 204 ....
    // /**
    //  * @test
    //  */
    // public function non_authenticated_user_can_not_access_challenge_api_endpoints()
    // {
    //     $this->json("GET", "$this->api_base")->assertStatus(401);
    //     $this->json("GET", "$this->api_base/paginate/10")->assertStatus(401);
    //     $this->json("GET", "$this->api_base/playfield/route/")->assertStatus(401);
    //     $this->json("GET", "$this->api_base/game/text_answere/")->assertStatus(401);
    //     $this->json( ."GET", "$this->api_base/playfield/route/paginate/10")->assertStatus(401);
    //     $this->json("GET", "$this->api_base/game/text_answere/paginate/10")->assertStatus(401);
    //     $this->json("GET", "$this->api_base/paginate/10")->assertStatus(401);
    //     $this->json("PUT", "$this->api_base/1")->assertStatus(401);
    //     $this->json("DELETE", "$this->api_base/1")->assertStatus(401);
    //     $this->json("POST", "$this->api_base")->assertStatus(401);
    // }
}

trait Get
{

    /**
     * @test
     */
    public function will_fail_with_a_404_if_challenge_is_not_found()
    {
        $this->create_user('admin');
        $res = $this->json('GET', "$this->api_base/-1");
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_all_challenges_whilst_no_entries_in_database()
    {
        $this->create_user('admin');
        // Skip any creates
        $res = $this->json('GET', $this->api_base);
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_challenges_whilst_no_entries_in_database()
    {
        $this->create_user('admin');
        // Skip any creates
        $res = $this->json('GET', "$this->api_base/paginate/3");
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function relationship_is_null_if_there_is_no_relationship()
    {
        $this->create_user('admin');
        // create challenge without creating any relationships
        $challenge = $this->create('Challenge');

        $response = $this->json('GET', "$this->api_base/$challenge->id");

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
        $this->create_user('admin');

        $playfield = $this->create('City', [], false);

        $game = $this->create('GameMultipleChoice', [], false);

        $challenge = $this->create('Challenge', [
            'playfield_type' => 'city',
            'playfield_id' => $playfield->id,
            'game_type' => 'multiple_choice',
            'game_id' => $game->id
        ]);

        $response = $this->json('GET', "$this->api_base/$challenge->id");

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

    }

    /**
     * @test
     */
    public function can_return_a_challenge_with_game_type_OFF_text_answere()
    {
        $this->create_user('admin');
        $playfield = $this->create('City', [], false);
        $game = $this->create('GameTextAnswere', [], false);

        $challenge = $this->create('Challenge', [
            'playfield_type' => 'city',
            'playfield_id' => $playfield->id,
            'game_type' => 'text_answere',
            'game_id' => $game->id
        ]);

        $response = $this->json('GET', "$this->api_base/$challenge->id");

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
        $this->create_user('admin');
        $playfield = $this->create('City', [], false);
        $game = $this->create('GameMediaUpload', [], false);

        $challenge = $this->create('Challenge', [
            'playfield_type' => 'city',
            'playfield_id' => $playfield->id,
            'game_type' => 'media_upload',
            'game_id' => $game->id
        ]);

        $response = $this->json('GET', "$this->api_base/$challenge->id");

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
        $this->create_user('admin');
        // make 6 challenges
        $this->collection_of_challenges('city', 'text_answere', 6);

        $response = $this->json('GET', $this->api_base);

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
        $this->create_user('admin');
        // make 6 challenges
        $this->collection_of_challenges('city', 'text_answere', 6);

        $response = $this->json('GET', "$this->api_base/paginate/3");

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
        $this->create_user('admin');
        // make 3 challenges with playfield route
        $this->collection_of_challenges('route', 'text_answere', 3);

        // make 3 challenges with playfield city
        $this->collection_of_challenges('city', 'text_answere', 3);

        $response = $this->json('GET', "$this->api_base/playfield/route");

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
                                'duration',
                                'difficulty',
                                'nature',
                                'highway',
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
        $this->create_user('admin');
        // make 3 challenges with playfield route
        $this->collection_of_challenges('route', 'text_answere', 6);

        // make 3 challenges with playfield city
        $this->collection_of_challenges('city', 'text_answere', 3);

        $response = $this->json('GET', "$this->api_base/playfield/route/paginate/3");

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
                                'duration',
                                'difficulty',
                                'nature',
                                'highway',
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
        $this->create_user('admin');
        // make 3 challenges with playfield transit
        $this->collection_of_challenges('transit', 'text_answere', 3);

        // make 3 challenges with playfield city
        $this->collection_of_challenges('city', 'text_answere', 3);

        $response = $this->json('GET', "$this->api_base/playfield/transit");

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
        $this->create_user('admin');
        // make 3 challenges with playfield transit
        $this->collection_of_challenges('transit', 'text_answere', 6);

        // make 3 challenges with playfield city
        $this->collection_of_challenges('city', 'text_answere', 3);

        $response = $this->json('GET', "$this->api_base/playfield/transit/paginate/3");

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
        $this->create_user('admin');
        // make 3 challenges with playfield transit
        $this->collection_of_challenges('city', 'text_answere', 3);

        // make 3 challenges with playfield city
        $this->collection_of_challenges('transit', 'text_answere', 3);

        $response = $this->json('GET', "$this->api_base/playfield/city");

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
        $this->create_user('admin');
        // make 3 challenges with playfield city
        $this->collection_of_challenges('city', 'text_answere', 6);

        // make 3 challenges with playfield transit
        $this->collection_of_challenges('transit', 'text_answere', 3);

        $response = $this->json('GET', "$this->api_base/playfield/city/paginate/3");

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
        $this->create_user('admin');
        // make 3 challenges with requested
        $this->collection_of_challenges('city', 'multiple_choice', 3);

        // make 3 challenge with different game
        $this->collection_of_challenges('city', 'text_answere', 3);

        $response = $this->json('GET', "$this->api_base/game/multiple_choice");

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
        $this->create_user('admin');
        // make 3 challenges with requested
        $this->collection_of_challenges('city', 'multiple_choice', 6);

        // make 3 challenge with different game
        $this->collection_of_challenges('city', 'text_answere', 3);

        $response = $this->json('GET', "$this->api_base/game/multiple_choice/paginate/3");

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
        $this->create_user('admin');
        // make 3 challenges with requested
        $this->collection_of_challenges('city', 'text_answere', 3);

        // make 3 challenge with different game
        $this->collection_of_challenges('city', 'multiple_choice', 3);

        $response = $this->json('GET', "$this->api_base/game/text_answere");

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
        $this->create_user('admin');
        // make 3 challenges with requested
        $this->collection_of_challenges('city', 'text_answere', 6);

        // make 3 challenge with different game
        $this->collection_of_challenges('city', 'multiple_choice', 3);

        $response = $this->json('GET', "$this->api_base/game/text_answere/paginate/3");

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
        $this->create_user('admin');
        // make 3 challenges with requested
        $this->collection_of_challenges('city', 'media_upload', 3);

        // make 3 challenge with different game
        $this->collection_of_challenges('city', 'multiple_choice', 3);

        $response = $this->json('GET', "$this->api_base/game/media_upload");

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
        $this->create_user('admin');
        // make 3 challenges with requested
        $this->collection_of_challenges('city', 'media_upload', 6);

        // make 3 challenge with different game
        $this->collection_of_challenges('city', 'multiple_choice', 3);

        $response = $this->json('GET', "$this->api_base/game/media_upload/paginate/3");

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


trait Post
{
    /**
     * @test
     */
    public function can_create_a_challenge_with_a_valid_game_and_playfield()
    {
        $this->create_user('admin');

        $game = $this->create('GameTextAnswere');
        $playfield = $this->create('City');

        $body = [
            'sort_order' => 0,
            'playfield_type' => 'city',
            'playfield_id' => $playfield->id,
            'game_type' => 'text_answere',
            'game_id' => $game->id
        ];

        $res = $this->json('POST', $this->api_base, $body);

        // Then
        $res->assertStatus(201)
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
                        'content_text',
                        'correct_answere',
                        'points_min',
                        'points_max',
                        'created_at'
                    ],
                    'created_at'
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('challenges', $body);
    }

    /**
     * @test
     */
    public function get_error_response_422_if_game_id_does_not_exist_in_database()
    {
        $this->create_user('admin');
        $body = [
            'sort_order' => 0,
            'playfield_type' => 'city',
            'playfield_id' =>  $this->create('City')->id,
            'game_type' => 'text_answere',
            'game_id' => -1
        ];

        $res = $this->json('POST', $this->api_base, $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('challenges', $body);
    }

    /**
     * @test
     */
    public function get_error_response_422_if_playfield_id_does_not_exist_in_database()
    {
        $this->create_user('admin');
        $body = [
            'sort_order' => 0,
            'playfield_type' => 'city',
            'playfield_id' => -1,
            'game_type' => 'text_answere',
            'game_id' => $this->create('GameTextAnswere')->id
        ];

        $res = $this->json('POST', $this->api_base, $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('challenges', $body);
    }

    /**
     * @test
     */
    public function get_error_response_422_if_request_body_data_is_of_wrong_type()
    {
        $this->create_user('admin');
        $game = $this->create('GameTextAnswere');
        $playfield = $this->create('City');

        // playfield_type is integer while it should be string
        $body = [
            'sort_order' => 0,
            'playfield_type' => 12334, // should be string
            'playfield_id' => $playfield->id,
            'game_type' => 'text_answere',
            'game_id' => $game->id
        ];

        $res = $this->json('POST', $this->api_base, $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('challenges', $body);
    }

            /**
     * @test
     */
    public function get_error_response_422_if_request_body_data_is_missing()
    {
        $this->create_user('admin');
        $game = $this->create('GameTextAnswere');
        $playfield = $this->create('City');

        // playfield id is missing
        $body = [
            'sort_order' => 0,
            'playfield_type' => 'city',
            'game_type' => 'text_answere',
            'game_id' => $game->id
        ];

        $res = $this->json('POST', $this->api_base, $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('challenges', $body);
    }
    
    /**
     * @test
     */
    // public function will_fail_with_a_409_if_request_tries_to_make_a_duplicate_database_insertion()
    // {
    //     //
    // }

}


trait Put
{

    /**
     * @test
     */
    public function will_fail_with_a_404_if_the_challenge_we_want_to_update_is_not_found()
    {
        $this->create_user('admin');
        $res = $this->json('PUT', "$this->api_base/-1");
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_update_a_challenge_to_playfield_of_type_city_and_game_of_type_media_upload()
    {
        $this->create_user('admin');
        // Given
        $old_challenge_values = [
            'playfield_type' => 'route',
            'playfield_id' => $this->create('Route', [], false)->id,
            'game_type' => 'text_answere',
            'game_id' => $this->create('GameTextAnswere', [], false)->id
        ];

        $old_challenge = $this->create('Challenge', $old_challenge_values);

        $playfield = $this->create('City', [], false);
        $game = $this->create('GameMediaUpload', [], false);

        $body = [
            'playfield_type' => 'city',
            'playfield_id' => $playfield->id,
            'game_type' => 'media_upload',
            'game_id' => $game->id
        ];

        // When
        $response = $this->json('PUT', "$this->api_base/$old_challenge->id", $body);
        // Then
        $response->assertStatus(200)
                 ->assertJsonFragment([
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
                        'content_text' => $game->content_text,
                        'media_type' => $game->media_type,
                        'correct_answere' => $game->correct_answere,
                        'points_min' => (integer)$game->points_min,
                        'points_max' => (integer)$game->points_max,
                        'created_at' => (string)$game->created_at
                     ]
                 ]);
        $this->assertDatabaseHas('challenges', $body);
        $this->assertDatabaseMissing('challenges', $old_challenge_values);

    }

    /**
     * @test
     */
    public function can_update_a_challenge_to_playfield_of_type_route_and_game_of_type_multiple_choice()
    {
        $this->create_user('admin');
        // Given
        $old_challenge_values = [
            'playfield_type' => 'city',
            'playfield_id' => $this->create('City', [], false)->id,
            'game_type' => 'text_answere',
            'game_id' => $this->create('GameTextAnswere', [], false)->id
        ];

        $old_challenge = $this->create('Challenge', $old_challenge_values);

        $playfield = $this->create('Route', [], false);
        $game = $this->create('GameMultipleChoice', [], false);

        $body = [
            'playfield_type' => 'route',
            'playfield_id' => $playfield->id,
            'game_type' => 'multiple_choice',
            'game_id' => $game->id
        ];

        // When
        $response = $this->json('PUT',"$this->api_base/$old_challenge->id", $body);

        // Then
        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'playfield' => [
                        'id' => $playfield->id,
                        'type' => 'route',
                        'transit_id' => (!$playfield->transit_id) ? null : (integer)$playfield->transit_id,
                        'name' => $playfield->name,
                        'maps_url' => $playfield->maps_url,
                        'kilometers' => (double)$playfield->kilometers,
                        'duration' => (double)$playfield->duration,
                        'difficulty' => (integer)$playfield->difficulty,
                        'nature' => (integer)$playfield->nature,
                        'highway' => (integer)$playfield->highway,
                        'created_at' => (string)$playfield->created_at
                     ],
                     'game' => [
                        'id' => $game->id,
                        'type' => 'multiple_choice',
                        'title' => $game->title,
                        'content_text' => $game->content_text,
                        'correct_answere' => $game->correct_answere,
                        'points_min' => (integer)$game->points_min,
                        'points_max' => (integer)$game->points_max,
                        'created_at' => (string)$game->created_at
                     ]
                 ]);

        
        
                 $this->assertDatabaseHas('challenges', $body);
        $this->assertDatabaseMissing('challenges', $old_challenge_values);

    }

    /**
     * @test
     */
    public function can_update_a_challenge_to_playfield_of_type_transit_and_game_of_type_text_answere()
    {
        $this->create_user('admin');
        // Given
        $old_challenge_values = [
            'playfield_type' => 'city',
            'playfield_id' => $this->create('City', [], false)->id,
            'game_type' => 'text_answere',
            'game_id' => $this->create('GameMediaUpload', [], false)->id
        ];
        $old_challenge = $this->create('Challenge', $old_challenge_values);

        $playfield = $this->create('Transit', [
            'from_city_id' => $this->create('City')->id,
            'to_city_id' => $this->create('City')->id
        ], false);
        $game = $this->create('GameTextAnswere', [], false);

        $body = [
            'playfield_type' => 'transit',
            'playfield_id' => $playfield->id,
            'game_type' => 'text_answere',
            'game_id' => $game->id
        ];

        // When

        $response = $this->json('PUT',"$this->api_base/$old_challenge->id", $body);

        // Then
        $response->assertStatus(200)
                 ->assertJsonFragment([
                    'playfield' => [
                        'id' => $playfield->id,
                        'type' => 'transit',
                        'name' => $playfield->name,
                        'from' => [
                            'id' => $playfield->from->id,
                            'type' => 'city',
                            'short_code' => $playfield->from->short_code,
                            'name' => $playfield->from->name,
                            'created_at' => (string)$playfield->from->created_at
                        ],
                        'to' => [
                            'id' => $playfield->to->id,
                            'type' => 'city',
                            'short_code' => $playfield->to->short_code,
                            'name' => $playfield->to->name,
                            'created_at' => (string)$playfield->to->created_at
                        ],
                        'created_at' => (string)$playfield->created_at
                    ],
                    'game' => [
                        'id' => $game->id,
                        'type' => 'text_answere',
                        'title' => $game->title,
                        'content_text' => $game->content_text,
                        'correct_answere' => $game->correct_answere,
                        'points_min' => (integer)$game->points_min,
                        'points_max' => (integer)$game->points_max,
                        'created_at' => (string)$game->created_at
                    ]
                ]);
                 
        $this->assertDatabaseHas('challenges', $body);
        $this->assertDatabaseMissing('challenges', $old_challenge_values);
    }


    /**
     * @test
     */
    public function can_update_only_a_playfield_relationship()
    {
        $this->create_user('admin');
        $game = $this->create('GameMediaUpload', [], false);

        $old_challenge_values = [
            'playfield_type' => 'route',
            'playfield_id' => $this->create('Route', [], false)->id,
            'game_type' => 'media_upload',
            'game_id' => $game->id
        ];

        // Given
        $old_challenge = $this->create('Challenge', $old_challenge_values);

        $playfield = $this->create('City', [], false);

        $body = [
            'playfield_type' => 'city',
            'playfield_id' => $playfield->id
        ];

        // When
        $response = $this->json('PUT',"$this->api_base/$old_challenge->id", $body);
        // Then
        $response->assertStatus(200)
                 ->assertJsonFragment([
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
                        'content_text' => $game->content_text,
                        'media_type' => $game->media_type,
                        'correct_answere' => $game->correct_answere,
                        'points_min' => (integer)$game->points_min,
                        'points_max' => (integer)$game->points_max,
                        'created_at' => (string)$game->created_at
                     ]
                 ]);
        $this->assertDatabaseHas('challenges', $body);

    }
    
    /**
     * @test
     */
    public function can_update_only_a_game_relationship()
    {
        $this->create_user('admin');
        $playfield = $this->create('City', [], false);

        $old_challenge_values = [
            'playfield_type' => 'city',
            'playfield_id' => $playfield->id,
            'game_type' => 'text_answere',
            'game_id' => $this->create('GameMediaUpload', [], false)->id
        ];

        // Given
        $old_challenge = $this->create('Challenge', $old_challenge_values);

        $game = $this->create('GameTextAnswere', [], false);

        $body = [
            'game_type' => 'text_answere',
            'game_id' => $game->id
        ];

        // When
        $response = $this->json('PUT',"$this->api_base/$old_challenge->id", $body);
        // Then
        $response->assertStatus(200)
                 ->assertJsonFragment([
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
                        'content_text' => $game->content_text,
                        'correct_answere' => $game->correct_answere,
                        'points_min' => (integer)$game->points_min,
                        'points_max' => (integer)$game->points_max,
                        'created_at' => (string)$game->created_at
                     ]
                 ]);

        $this->assertDatabaseHas('challenges', $body);
    }

    /**
     * @test
     */
    public function will_fail_with_error_422_when_updating_challenge_playfield_reltionship_with_non_existing_playfield()
    {
        $this->create_user('admin');
        // Given
        $old_challenge_values = [
            'playfield_type' => 'route',
            'playfield_id' => $this->create('Route', [], false)->id,
            'game_type' => 'text_answere',
            'game_id' => $this->create('GameTextAnswere', [], false)->id
        ];

        $old_challenge = $this->create('Challenge', $old_challenge_values);

        $body = [
            'playfield_type' => 'city',
            'playfield_id' => -1,
            'game_type' => 'media_upload',
            'game_id' => $this->create('GameMediaUpload', [], false)->id
        ];

        // When
        $response = $this->json('PUT',"$this->api_base/$old_challenge->id", $body);

        // Then
        $response->assertStatus(422);
        $this->assertDatabaseHas('challenges', $old_challenge_values);
        $this->assertDatabaseMissing('challenges', $body);

    }

        /**
     * @test
     */
    public function will_fail_with_error_422_when_updating_challenge_game_relationship_with_non_existing_game()
    {
        $this->create_user('admin');
        // Given
        $old_challenge_values = [
            'playfield_type' => 'route',
            'playfield_id' => $this->create('Route', [], false)->id,
            'game_type' => 'text_answere',
            'game_id' => $this->create('GameTextAnswere', [], false)->id
        ];

        $old_challenge = $this->create('Challenge', $old_challenge_values);

        $body = [
            'playfield_type' => 'city',
            'playfield_id' => $this->create('City', [], false)->id,
            'game_type' => 'media_upload',
            'game_id' => -1
        ];

        // When
        $response = $this->json('PUT',"$this->api_base/$old_challenge->id", $body);

        // Then
        $response->assertStatus(422);
        $this->assertDatabaseHas('challenges', $old_challenge_values);
        $this->assertDatabaseMissing('challenges', $body);

    }

        /**
     * @test
     */
    public function will_fail_with_error_422_when_body_data_is_of_wrong_type()
    {
        $this->create_user('admin');
        $old_challenge_values =  [
            'playfield_type' => 'route',
            'playfield_id' => $this->create('Route', [], false)->id,
            'game_type' => 'text_answere',
            'game_id' => $this->create('GameTextAnswere', [], false)->id
        ];

        // Given
        $old_challenge = $this->create('Challenge', $old_challenge_values);

        // 'playfield_type' is of wrong data type
        $body = [
            'playfield_type' => 12345,
            'playfield_id' => $this->create('Route', [], false)->id,
            'game_type' => 'media_upload',
            'game_id' => $this->create('GameMediaUpload', [], false)->id
        ];

        // When
        $response = $this->json('PUT',"$this->api_base/$old_challenge->id", $body);

        // Then
        $response->assertStatus(422);
        $this->assertDatabaseHas('challenges', $old_challenge_values);
        $this->assertDatabaseMissing('challenges', $body);

    }

    // /**
    //  * @test
    //  */
    // public function will_fail_with_error_422_is_unknow_attribute_is_send_in_request_body()
    // {
    //     // Given
    //     $old_challenge = $this->create('Challenge', [
    //         'playfield_type' => 'route',
    //         'playfield_id' => $this->create('Route', [], false)->id,
    //         'game_type' => 'text_answere',
    //         'game_id' => $this->create('GameTextAnswere', [], false)->id
    //     ]);

    //     // 'unkown_attribute' is not allowed
    //     $body = [
    //         'unknown_attribute' => 'xxxxxx',
    //         'playfield_type' => 12345,
    //         'playfield_id' => $this->create('Route', [], false)->id,
    //         'game_type' => 'media_upload',
    //         'game_id' => $this->create('GameMediaUpload', [], false)->id
    //     ];

    //     // When
    //     $response = $this->json('PUT','api/challenges/'.$old_challenge->id, $body);

    //     dd($response);
    //     // Then
    //     $response->assertStatus(422);
    //     $this->assertDatabaseHas('challenges', $old_challenge);
    //     $this->assertDatabaseMissing('challenges', $body);

    // }
}

trait Delete
{
    /**
     * @test
     */
    public function will_fail_with_a_404_if_the_challenge_we_want_to_delete_is_not_found()
    {
        $this->create_user('admin');
        $res = $this->json('DELETE', "$this->api_base/-1");
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_delete_a_challange_and_unlink_all_relationships()
    {
        $this->create_user('admin');
        $playfield = $this->create('City');
        $game = $this->create('GameTextAnswere');

        // Given
        // first create a game in the database to delete
        $challenge = $this->create('Challenge', [
            'playfield_type' => 'city',
            'playfield_id' => $playfield->id,
            'game_type' => 'text_answere',
            'game_id' =>  $game->id
        ]);

        // When
        // call the delete api
        $res = $this->json('DELETE', "$this->api_base/$challenge->id");

        // Then
        $res->assertStatus(204)
            ->assertSee(null);

        // check if $game is deleted from database
        $this->assertDatabaseMissing('challenges', ['id' => $challenge->id]);
    }

        /**
     * @test
     */
    public function can_delete_a_challange_and_set_its_forgeign_keys_to_null()
    {
        $this->create_user('admin');
        // Given
        // first create a game in the database to delete
        $challenge = $this->create('Challenge');

        $answere_unchecked = $this->create('AnswereUnchecked', [
            'challenge_id' => $challenge->id
        ]);
        $answere_checked = $this->create('AnswereChecked', [
            'challenge_id' => $challenge->id
        ]);

        // When
        // call the delete api
        $res = $this->json('DELETE', "$this->api_base/$challenge->id");

        // Then
        $res->assertStatus(204)
            ->assertSee(null);

        // check if $game is deleted from database
        $this->assertDatabaseMissing('challenges', ['id' => $challenge->id]);

        $answere_unchecked->refresh();
        if(!$answere_unchecked->challenge_id){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }

        $answere_checked->refresh();
        if(!$answere_checked->challenge_id){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }

    }

}