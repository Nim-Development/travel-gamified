<?php 

namespace Tests\Feature\Http\Controllers\Admin\Games\GameMultipleChoiceController;

trait Get
{
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
}


