<?php 

namespace Tests\Feature\Http\Controllers\Admin\Games\GameTextAnswereController;

trait Get
{

    /**
     * @test
     */
    public function will_fail_with_a_404_if_game_of_type_text_answere_is_not_found()
    {
        $res = $this->json('GET', 'api/games/text_answere/-1');
        $res->assertStatus(404);
    }

        /**
     * @test
     */
    public function will_return_204_when_requesting_all_text_answere_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/games/text_answere');
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_text_answere_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/games/text_answere/paginate/3');
        $res->assertStatus(204);
    }



    /**
     * @test
     */
    public function can_return_all_games_of_type_text_answere()
    {
        // Given, multiple multiple choice options
        $this->create_collection('Games\GameTextAnswere', [], true, $qty = 6);

        // When
        $result = $this->json('GET', '/api/games/text_answere');

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
                        'created_at'
                    ]
                ],
            ]);
    }

        /**
     * @test
     */
    public function can_return_all_games_of_type_text_answere_paginated()
    {
        //Given
        $this->create_collection('Games\GameTextAnswere', [], true, $qty = 6);

        // When
        $result = $this->json('GET', '/api/games/text_answere/paginate/3');

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
    public function can_get_a_single_game_of_type_text_answere()
    {
        // Given
        $game = $this->create('Games\GameTextAnswere');

        // When
        $result = $this->json('GET', "/api/games/text_answere/$game->id");

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
                    'created_at' => (string)$game->created_at
                ]
            ]);

    }

}


