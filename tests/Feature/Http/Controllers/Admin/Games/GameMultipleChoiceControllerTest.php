<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Faker\Factory;
use Illuminate\Support\Str;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameMultipleChoiceControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    // public function non_authenticated_user_can_not_access_game_api_endpoints()
    // {
    //     $this->json('GET', '/api/games')->assertStatus(401);
    //     $this->json('GET', 'api/games/1')->assertStatus(401);
    //     $this->json('PUT', 'api/games/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/games/1')->assertStatus(401);
    //     $this->json('POST', '/api/games')->assertStatus(401);
    // }

    /**
     * @test
     */
    public function will_fail_with_a_404_if_game_of_type_multiple_choice_is_not_found()
    {
        $res = $this->json('GET', 'api/games/multiple_choice/-1');
        $res->assertStatus(404);
    }

        /**
     * @test
     */
    public function will_fail_with_a_204_if_requesting_options_from_a_game_that_has_no_options()
    {
        $game = $this->create('Games\GameMultipleChoice');
        $res = $this->json('GET', "api/games/multiple_choice/$game->id/options");
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_fail_with_a_204_if_requesting_paginated_options_from_database_but_there_are_no_options()
    {
        $res = $this->json('GET', "api/games/multiple_choice/options/paginate/1");
        $res->assertStatus(204);
    }

        /**
     * @test
     */
    public function will_fail_with_a_204_if_requesting_all_options_from_database_but_there_are_no_options()
    {
        $res = $this->json('GET', "api/games/multiple_choice/options");
        $res->assertStatus(204);
    }

        /**
     * @test
     */
    public function will_return_204_when_requesting_all_multiple_choice_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/games/multiple_choice');
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_multiple_choice_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/games/multiple_choice/paginate/3');
        $res->assertStatus(204);
    }


    // /**
    //  * @test
    //  */
    // public function will_fail_with_a_404_if_the_game_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/games/-1');
    //     $res->assertStatus(404);
    // }

    //     /**
    //  * @test
    //  */
    // public function will_fail_with_a_404_if_the_game_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/games/-1');
    //     $res->assertStatus(404);
    // }

    // /**
    //  * A basic feature test example.
    //  * // @test << ::nk Makes it so that we dont have to add test prefix infront of each method!!
    //  *
    //  * @test
    //  *
    //  */
    // public function can_create_a_game()
    // {

    //     $faker = Factory::create();

    //     $game_data = [

    //     ];

    //     $res = $this->json('POST', '/api/games', $game_data);

    //     // Then
    //         // Describes the outcome of Action according to conditions in Given

    //     $res->assertJsonStructure([])
    //         ->assertJson($game_data)
    //         ->assertStatus(201);

    //     // assert if the game has been added to the database
    //     $this->assertDatabaseHas('games', $game_data);

    // }

    // /**
    //  * @test
    //  */
    // public function can_update_a_game()
    // {
    //     // Given
    //     $old_game = $this->create('Games\Game');

    //     $new_game = [
    //         'name' => $old_game->name.'_update',
    //         'slug' => $old_game->slug.'_update',
    //         'price' => $old_game->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/games/'.$old_game->id,
    //                             $new_game);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_game);
    //     $this->assertDatabaseHas('games', $new_game);

    // }

    // /**
    //  * @test
    //  */
    // public function can_delete_a_game()
    // {
    //     // Given
    //     // first create a game in the database to delete
    //     $game = $this->create('Games\Game');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/games/'.$game->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $game is deleted from database
    //     $this->assertDatabaseMissing('games', ['id' => $game->id]);
    // }

    // /**
    //  * @test
    //  */
    // public function can_return_a_game()
    // {
    //     // Given
    //     // inserting a model into the database (we know this will work because test can_create_a_game() was asserted succesfully)
    //     $game = $this->create('Games\Game');

    //     // When
    //     $response = $this->json('GET', '/api/games/'.$game->id);

    //     // Then
    //     // assert status code
    //     $response->assertStatus(200)
    //              ->assertExactJson([
    //                 'id' => $game->id,
    //                 'name' => $game->name,
    //                 'slug' => $game->slug,
    //                 'price' => $game->price,
    //                 'created_at' => (string)$game->created_at,
    //                 // 'updated_at' => (string)$game->updated_at
    //             ]);

    // }

    // /**
    //  * @test
    //  */
    // public function can_return_a_collection_of_paginated_games()
    // {
    //     $game_1 = $this->create('Games\Game');
    //     $game_2 = $this->create('Games\Game');
    //     $game_3 = $this->create('Games\Game');

    //     $response = $this->json('GET', '/api/games');

    //     $response->assertStatus(200)
    //             ->assertJsonStructure([
    //                 'data' => [
    //                     '*' => [ //* to say we checking keys of multiple collections

    //                     ]
    //                 ],
    //                 // Check if it is paginated
    //                 'links' => ['first', 'last', 'prev', 'next'],
    //                 'meta' => [
    //                     'current_page', 'last_page', 'from', 'to',
    //                     'path', 'per_page', 'total'
    //                 ]
    //             ]);
    // }


    /**
     * @test
     */
    public function returns_a_null_value_on_options_relationship_if_there_are_no_options_available()
    {
        // create game without options
        $game = $this->create('Games\GameMultipleChoice');

        // When
        $result = $this->json('GET', '/api/games/multiple_choice/'.$game->id);

        // Then
        $result->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    'id' => $game->id,
                    'title' => $game->title,
                    'content_media' => $game->content_media,
                    'content_text' => $game->content_text,
                    'correct_answere' => $game->correct_answere,
                    'points_min' => $game->points_min,
                    'points_max' => $game->points_max,
                    'options' => null,
                    'created_at' => (string)$game->created_at
                ]
            ]);
    }

     


    /**
     * @test
     */
    public function can_get_all_GAMES_of_type_multiple_choice()
    {
        // Given
        $games = $this->create_collection('Games\GameMultipleChoice', [], false, $qty = 6);

        // insert 3 options per game in collection
        $this->link_options_to_each_game_collection_item($games, 3);

        // // create 3 options and link them to $game
        // $this->create_collection('Games\GameMultipleChoiceOption', ['game_id' => $game->id], true, $qty = 3);

        // When
        $result = $this->json('GET', '/api/games/multiple_choice');

        // Then
        $result->assertStatus(200)
               ->assertJsonCount(6, 'data')
               ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'content_media',
                        'content_text',
                        'correct_answere',
                        'points_min',
                        'points_max',
                        'options' => [
                            '*' => [
                                'id',
                                'sort_order',
                                'text',
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
    public function can_return_all_GAMES_of_type_multiple_choice_paginated()
    {
        //Given
        $games = $this->create_collection('Games\GameMultipleChoice', [], true, $qty = 6);

        // insert 3 options per game in collection
        $this->link_options_to_each_game_collection_item($games, 3);

        // When
        $result = $this->json('GET', '/api/games/multiple_choice/paginate/3');

        // Then
        $result->assertStatus(200)
               ->assertJsonCount(3, 'data')
               ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'content_media',
                        'content_text',
                        'correct_answere',
                        'points_min',
                        'points_max',
                        'options' => [
                            '*' => [
                                'id',
                                'sort_order',
                                'text',
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

    /**
     * @test
     */
    public function can_get_a_single_GAME_of_type_multiple_choice()
    {
        // Given
        $game = $this->create('Games\GameMultipleChoice');

        // create 3 options and link them to $game
        $this->create_collection('Games\GameMultipleChoiceOption', ['game_id' => $game->id], true, $qty = 3);

        // When
        $result = $this->json('GET', "/api/games/multiple_choice/$game->id");

        // Then
        $result->assertStatus(200)
               ->assertJsonCount(3, 'data.options')
               ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'content_media',
                    'content_text',
                    'correct_answere',
                    'points_min',
                    'points_max',
                    'options' => [
                        '*' => [
                            'id',
                            'sort_order',
                            'text',
                            'created_at'
                        ]
                    ],
                    'created_at'
                ]
            ]);
    }

    /**
     * @test
     */
    public function can_return_all_multiple_choice_game_OPTIONS()
    {

        // Given, multiple multiple choice options
        $this->create_collection('Games\GameMultipleChoiceOption', [], true, $qty = 6);

        // When
        $result = $this->json('GET', '/api/games/multiple_choice/options');
        // Then
        $result->assertStatus(200)
               ->assertJsonCount(6, 'data')
               ->assertJsonStructure([
                'data' => [
                    '*' => ['id','game_id', 'sort_order', 'text','created_at']
                ],
            ]);
    }

        /**
     * @test
     */
    public function can_return_all_multiple_choice_game_OPTIONS_paginated()
    {
        // Given, multiple multiple choice options
        $this->create_collection('Games\GameMultipleChoiceOption', [], true, $qty = 6);

        // When
        $result = $this->json('GET', '/api/games/multiple_choice/options/paginate/3');

        // Then
        $result->assertStatus(200)
               ->assertJsonCount(3, 'data')
               ->assertJsonStructure([
                'data' => [
                    '*' => ['id','game_id', 'sort_order', 'text','created_at']
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
    public function get_OPTIONS_from_a_single_multiple_choice_game()
    {

        // Given
        $game = $this->create('Games\GameMultipleChoice');

        // make 3 options and bind them to $game by game_id
        $this->create_collection('Games\GameMultipleChoiceOption', ['game_id' => $game->id], true, $qty = 3);

        // When
        $result = $this->json('GET', "/api/games/multiple_choice/$game->id/options");

        // Then
        $result->assertStatus(200)
               ->assertJsonCount(3, 'data')
               ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'game_id', 'sort_order', 'text','created_at']
                ]
            ]
        );

    }
    
    // Route::get('games/multiple_choice/options', 'Admin\GameController@ALL_multiple_choice_options');
    // Route::get('games/multiple_choice/{id}/options', 'Admin\GameController@SINGLE_multiple_choice_options');



}
