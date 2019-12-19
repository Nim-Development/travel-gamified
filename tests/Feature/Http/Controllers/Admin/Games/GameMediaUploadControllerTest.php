<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Faker\Factory;
use Illuminate\Support\Str;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameMediaUploadControllerTest extends TestCase
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
    public function will_fail_with_a_404_if_game_of_type_media_upload_is_not_found()
    {
        $res = $this->json('GET', 'api/games/media_upload/-1');
        $res->assertStatus(404);
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
    public function can_return_all_games_of_type_media_upload()
    {
        // Given, multiple multiple choice options
        $this->create_collection('Games\GameMediaUpload', [], true, $qty = 6);

        // When
        $result = $this->json('GET', '/api/games/media_upload');

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
                        'media_type',
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
    public function can_return_all_games_of_type_media_upload_paginated()
    {
        //Given
        $this->create_collection('Games\GameMediaUpload', [], true, $qty = 6);

        // When
        $result = $this->json('GET', '/api/games/media_upload/paginate/3');

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
                        'media_type',
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
    public function can_get_a_single_game_of_type_media_upload()
    {
        // Given
        $game = $this->create('Games\GameMediaUpload');

        // When
        $result = $this->json('GET', "/api/games/media_upload/$game->id");

        // Then
        $result->assertStatus(200)
               ->assertExactJson([
                'data' => [
                    'id' => $game->id,
                    'title' => $game->title,
                    'content_media' => $game->content_media,
                    'content_text' => $game->content_text,
                    'media_type' => $game->media_type,
                    'correct_answere' => $game->correct_answere,
                    'points_min' => $game->points_min,
                    'points_max' => $game->points_max,
                    'created_at' => (string)$game->created_at
                ]
            ]);

    }





    // Route::get('games/multiple_choice/options', 'Admin\GameController@ALL_multiple_choice_options');
    // Route::get('games/multiple_choice/{id}/options', 'Admin\GameController@SINGLE_multiple_choice_options');


}
