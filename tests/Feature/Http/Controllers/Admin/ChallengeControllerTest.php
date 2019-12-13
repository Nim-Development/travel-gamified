<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Faker\Factory;
use Illuminate\Support\Str;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChallengeControllerTest extends TestCase
{

    use RefreshDatabase;




    /**
     * @test
     */
    // public function non_authenticated_user_can_not_access_challenge_api_endpoints()
    // {
    //     $this->json('GET', '/api/challenges')->assertStatus(401);
    //     $this->json('GET', 'api/challenges/1')->assertStatus(401);
    //     $this->json('PUT', 'api/challenges/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/challenges/1')->assertStatus(401);
    //     $this->json('POST', '/api/challenges')->assertStatus(401);
    // }

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
    // public function will_fail_with_a_404_if_the_challenge_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/challenges/-1');
    //     $res->assertStatus(404);
    // }

        /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_challenge_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/challenges/-1');
    //     $res->assertStatus(404);
    // }

    /**
     * A basic feature test example.
     * // @test << ::nk Makes it so that we dont have to add test prefix infront of each method!!
     *
     * @test
     *
     */
    // public function can_create_a_challenge()
    // {

    //     $faker = Factory::create();

    //     $challenge_data = [

    //     ];

    //     $res = $this->json('POST', '/api/challenges', $challenge_data);

    //     // Then
    //         // Describes the outcome of Action according to conditions in Given

    //     $res->assertJsonStructure([])
    //         ->assertJson($challenge_data)
    //         ->assertStatus(201);

    //     // assert if the challenge has been added to the database
    //     $this->assertDatabaseHas('challenges', $challenge_data);

    // }

    /**
     * @test
     */
    // public function can_update_a_challenge()
    // {
    //     // Given
    //     $old_challenge = $this->create('Challenge');

    //     $new_challenge = [
    //         'name' => $old_challenge->name.'_update',
    //         'slug' => $old_challenge->slug.'_update',
    //         'price' => $old_challenge->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/challenges/'.$old_challenge->id,
    //                             $new_challenge);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_challenge);
    //     $this->assertDatabaseHas('challenges', $new_challenge);

    // }

    /**
     * @test
     */
    // public function can_delete_a_challenge()
    // {
    //     // Given
    //     // first create a challenge in the database to delete
    //     $challenge = $this->create('Challenge');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/challenges/'.$challenge->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $challenge is deleted from database
    //     $this->assertDatabaseMissing('challenges', ['id' => $challenge->id]);
    // }

    /**
     * @test
     */
    public function can_return_a_challenge_with_game_type_OFF_multiple_choice()
    {
        $game_type = 'multiple_choice';

        // strip App\ model class namespace path
        $game_model_str = substr(get_class(config("models.games.$game_type")), 4);

        $game = $this->create($game_model_str, [], false);

        $challenge = $this->create('Challenge', [
            'game_type' => $game_type,
            'game_id' => $game->id
        ]);

        $response = $this->json('GET', '/api/challenges/'.$challenge->id);

        $response->assertStatus(200)
                ->assertExactJson([
                    'sort_order' => $challenge->sort_order,
                    'playfield_type' => $challenge->playfield_type,
                    'playfield_id' => $challenge->playfield_id,
                    'game_type' => $challenge->game_type,
                    'game_id' => $challenge->game_id,
                    'game' => [
                        'id' => $game->id,
                        'title' => $game->title,
                        'content_media' => $game->content_media,
                        'content_text' => $game->content_text,
                        'correct_answere' => $game->correct_answere,
                        'points_min' => $game->points_min,
                        'points_max' => $game->points_max,
                        'created_at' => $game->created_at
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_challenge_with_game_type_OFF_text_answere()
    {
        $game_type = 'text_answere';

        // strip App\ model class namespace path
        $game_model_str = substr(get_class(config("models.games.$game_type")), 4);

        $game = $this->create($game_model_str, [], false);

        $challenge = $this->create('Challenge', [
            'game_type' => $game_type,
            'game_id' => $game->id
        ]);

        $response = $this->json('GET', '/api/challenges/'.$challenge->id);

        $response->assertStatus(200)
                ->assertExactJson([
                    'sort_order' => $challenge->sort_order,
                    'playfield_type' => $challenge->playfield_type,
                    'playfield_id' => $challenge->playfield_id,
                    'game_type' => $challenge->game_type,
                    'game_id' => $challenge->game_id,
                    'game' => [
                        'id' => $game->id,
                        'title' => $game->title,
                        'content_media' => $game->content_media,
                        'content_text' => $game->content_text,
                        'correct_answere' => $game->correct_answere,
                        'points_min' => $game->points_min,
                        'points_max' => $game->points_max,
                        'created_at' => $game->created_at
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_challenge_with_game_type_OFF_media_upload()
    {
        $game_type = 'media_upload';

        // strip App\ model class namespace path
        $game_model_str = substr(get_class(config("models.games.$game_type")), 4);

        $game = $this->create($game_model_str, [], false);

        $challenge = $this->create('Challenge', [
            'game_type' => $game_type,
            'game_id' => $game->id
        ]);

        $response = $this->json('GET', '/api/challenges/'.$challenge->id);

        $response->assertStatus(200)
                ->assertExactJson([
                    'sort_order' => $challenge->sort_order,
                    'playfield_type' => $challenge->playfield_type,
                    'playfield_id' => $challenge->playfield_id,
                    'game_type' => $challenge->game_type,
                    'game_id' => $challenge->game_id,
                    'game' => [
                        'id' => $game->id,
                        'title' => $game->title,
                        'content_media' => $game->content_media,
                        'content_text' => $game->content_text,
                        'content_text' => $game->media_type,
                        'correct_answere' => $game->correct_answere,
                        'points_min' => $game->points_min,
                        'points_max' => $game->points_max,
                        'created_at' => $game->created_at
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_all_challenges()
    {
        $game_type = 'text_answere'; //type doesnt really matter for test.

        // strip App\ model class namespace path
        $game_model_str = substr(get_class(config("models.games.text_answere")), 4);

        $game = $this->create($game_model_str, [], false);

        // Make a couple of challenges
        $challenge_1 = $this->create('Challenge', [
            'game_type' => $game_type,
            'game_id' => $game->id
        ]);
        $challenge_2 = $this->create('Challenge', [
            'game_type' => $game_type,
            'game_id' => $game->id
        ]);
        $challenge_3 = $this->create('Challenge', [
            'game_type' => $game_type,
            'game_id' => $game->id
        ]);

        $response = $this->json('GET', '/api/challenges');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections
                            'sort_order',
                            'playfield_type',
                            'playfield_id',
                            'game_type',
                            'game_id',
                            'game' => [
                                'id',
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
    public function can_return_a_collection_of_all_challenges_paginated()
    {
        $game_type = 'text_answere'; //type doesnt really matter for test.

        // strip App\ model class namespace path
        $game_model_str = substr(get_class(config("models.games.text_answere")), 4);

        $game = $this->create($game_model_str, [], false);

        // Make a couple of challenges
        $this->create('Challenge', [
            'game_type' => $game_type,
            'game_id' => $game->id
        ]);
        $this->create('Challenge', [
            'game_type' => $game_type,
            'game_id' => $game->id
        ]);
        $this->create('Challenge', [
            'game_type' => $game_type,
            'game_id' => $game->id
        ]);
        $this->create('Challenge', [
            'game_type' => $game_type,
            'game_id' => $game->id
        ]);
        $this->create('Challenge', [
            'game_type' => $game_type,
            'game_id' => $game->id
        ]);
        $this->create('Challenge', [
            'game_type' => $game_type,
            'game_id' => $game->id
        ]);

        $response = $this->json('GET', '/api/challenges/paginate/3');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections
                            'sort_order',
                            'playfield_type',
                            'playfield_id',
                            'game_type',
                            'game_id',
                            'game' => [
                                'id',
                                'title',
                                'content_media',
                                'content_text',
                                'correct_answere',
                                'points_min',
                                'points_max',
                                'created_at'
                            ]
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
        $playfield_type = 'route';
        $game_type = 'multiple_choice';
        $qty = 6;
        // create 3 challenges with game type of multple_choice
        $challenges = $this->populate_challenges_with_relations($playfield_type, $game_type, $qty);

        // create 1 more challenge with other game type
        $this->create('Challenge', ['playfield_type' => 'xxxx']);

        $response = $this->json('GET', "challenges/playfield/$playfield_type");

        $response->assertStatus(200)
                 ->assertJsonCount($qty, 'data.*')
                 ->assertJsonHas($challenges);

    }
    /**
     * @test
     */
    public function can_get_all_challenges_with_playfield_type_of_route_paginated()
    {
        $playfield_type = 'route';
        $game_type = 'multiple_choice';
        $qty = 6;
        // create 3 challenges with game type of multple_choice
        $challenges = $this->populate_challenges_with_relations($playfield_type, $game_type, $qty);

        // create 1 more challenge with other game type
        $this->create('Challenge', ['playfield_type' => 'xxxx']);

        $response = $this->json('GET', "challenges/playfield/$playfield_type/paginate/3");

        $response->assertStatus(200)
                 ->assertJsonCount($qty, 'data.*')
                 ->assertJsonHas($challenges)
                 ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections

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
        $playfield_type = 'transit';
        $game_type = 'multiple_choice';
        $qty = 3;
        // create 3 challenges with game type of multple_choice
        $challenges = $this->populate_challenges_with_relations($playfield_type, $game_type, $qty);

        // create 1 more challenge with other game type
        $this->create('Challenge', ['playfield_type' => 'xxxx']);


        $response = $this->json('GET', "challenges/playfield/$playfield_type");

        $response->assertStatus(200)
                 ->assertJsonCount($qty, 'data.*')
                 ->assertJsonHas($challenges);
    }
    /**
     * @test
     */
    public function can_get_all_challenges_with_playfield_type_of_transit_paginated()
    {
        $playfield_type = 'transit';
        $game_type = 'text_answere';
        $qty = 6;
        // create 3 challenges with game type of multple_choice
        $challenges = $this->populate_challenges_with_relations($playfield_type, $game_type, $qty);

        // create 1 more challenge with other game type
        $this->create('Challenge', ['playfield_type' => 'xxxx']);

        $response = $this->json('GET', "challenges/playfield/$playfield_type/paginate/3");

        $response->assertStatus(200)
                 ->assertJsonCount($qty, 'data.*')
                 ->assertJsonHas($challenges)
                 ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections

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
        $playfield_type = 'city';
        $game_type = 'text_answere';
        $qty = 3;
        // create 3 challenges with game type of multple_choice
        $challenges = $this->populate_challenges_with_relations($playfield_type, $game_type, $qty);

        // create 1 more challenge with other game type
        $this->create('Challenge', ['playfield_type' => 'xxxx']);


        $response = $this->json('GET', "challenges/playfield/$playfield_type");

        $response->assertStatus(200)
                 ->assertJsonCount($qty, 'data.*')
                 ->assertJsonHas($challenges);
    }
    /**
     * @test
     */
    public function can_get_all_challenges_with_playfield_type_of_city_paginated()
    {
        $playfield_type = 'city';
        $game_type = 'text_answere';
        $qty = 6;
        // create 3 challenges with game type of multple_choice
        $challenges = $this->populate_challenges_with_relations($playfield_type, $game_type, $qty);

        // create 1 more challenge with other game type
        $this->create('Challenge', ['playfield_type' => 'xxxx']);

        $response = $this->json('GET', "challenges/playfield/$playfield_type/paginate/3");

        $response->assertStatus(200)
                 ->assertJsonCount($qty, 'data.*')
                 ->assertJsonHas($challenges)
                 ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections

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
        $playfield_type = 'city';
        $game_type = 'multiple_choice';
        $qty = 3;
        // create 3 challenges with game type of multple_choice
        $challenges = $this->populate_challenges_with_relations($playfield_type, $game_type, $qty);

        // create 1 more challenge with other game type
        $this->create('Challenge', ['game_type' => 'xxxx']);


        $response = $this->json('GET', "challenges/game/$game_type");
        $response->assertStatus(200)
                 ->assertJsonCount($qty, 'data.*')
                 ->assertJsonHas($challenges);
    }

    /**
     * @test
     */
    public function can_get_all_challenges_with_game_type_of_multiple_choice_paginated()
    {
        $playfield_type = 'city';
        $game_type = 'multiple_choice';
        $qty = 6;
        // create 3 challenges with game type of multple_choice
        $challenges_multiple_choice = $this->populate_challenges_with_relations($playfield_type, $game_type, $qty);

        // create 1 more challenge with other game type
        $this->create('Challenge', ['game_type' => 'xxxx']);


        $response = $this->json('GET', "challenges/game/$game_type/paginate/3");
        $response->assertStatus(200)
                 ->assertJsonCount($qty, 'data.*')
                 ->assertJsonHas($challenges)
                 ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections

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
    public function can_get_all_challenges_with_game_type_of_text_answere()
    {
        $playfield_type = 'city';
        $game_type = 'text_answere';
        $qty = 3;
        // create 3 challenges with game type of multple_choice
        $challenges_multiple_choice = $this->populate_challenges_with_relations($playfield_type, $game_type, $qty);

        // create 1 more challenge with other game type
        $this->create('Challenge', ['game_type' => 'xxxx']);


        $response = $this->json('GET', "challenges/game/$game_type");
        $response->assertStatus(200)
                 ->assertJsonCount($qty, 'data.*')
                 ->assertJsonHas($challenges);
    }

        /**
     * @test
     */
    public function can_get_all_challenges_with_game_type_of_text_answere_paginated()
    {

        $playfield_type = 'city';
        $game_type = 'text_answere';
        $qty = 6;
        // create 3 challenges with game type of multple_choice
        $challenges = $this->populate_challenges_with_relations($playfield_type, $game_type, $qty);

        // create 1 more challenge with other game type
        $this->create('Challenge', ['game_type' => 'xxxx']);


        $response = $this->json('GET', "challenges/game/$game_type/paginate/3");
        $response->assertStatus(200)
                 ->assertJsonCount($qty, 'data.*')
                 ->assertJsonHas($challenges)
                ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections

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
    public function can_get_all_challenges_with_game_type_of_media_upload()
    {
        $playfield_type = 'city';
        $game_type = 'media_upload';
        $qty = 3;
        // create 3 challenges with game type of multple_choice
        $challenges = $this->populate_challenges_with_relations($playfield_type, $game_type, $qty);

        // create 1 more challenge with other game type
        $this->create('Challenge', ['game_type' => 'xxxx']);


        $response = $this->json('GET', "challenges/game/$game_type");
        $response->assertStatus(200)
                 ->assertJsonCount($qty, 'data.*')
                 ->assertJsonHas($challenges);
    }


        /**
     * @test
     */
    public function can_get_all_challenges_with_game_type_of_media_upload_paginated()
    {
        $playfield_type = 'city';
        $game_type = 'media_upload';
        $qty = 6;
        // create 3 challenges with game type of multple_choice
        $challenges = $this->populate_challenges_with_relations($playfield_type, $game_type, $qty);

        // create 1 more challenge with other game type
        $this->create('Challenge', ['game_type' => 'xxxx']);


        $response = $this->json('GET', "challenges/game/$game_type/paginate/3");
        $response->assertStatus(200)
                 ->assertJsonCount($qty, 'data.*')
                 ->assertJsonHas($challenges)
        ->assertJsonStructure([
            'data' => [
                '*' => [ //* to say we checking keys of multiple collections

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
