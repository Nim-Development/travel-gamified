<?php

namespace Tests\Feature\Http\Controllers\Admin\Games\GameTextAnswereController;

use Faker\Factory;
use Tests\TestCase;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GameTextAnswereControllerTest extends TestCase
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
    // public function non_authenticated_user_can_not_access_game_api_endpoints()
    // {
    //     $this->json('GET', '/api/games')->assertStatus(401);
    //     $this->json('GET', 'api/games/1')->assertStatus(401);
    //     $this->json('PUT', 'api/games/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/games/1')->assertStatus(401);
    //     $this->json('POST', '/api/games')->assertStatus(401);
    // }
}

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
        $games = $this->create_collection('Games\GameTextAnswere', [], true, $qty = 6);

        foreach($games as $game){
            $this->file_factory($game, 'header', ['chelsea', 'liverpool']); // add 2 header media files
            $this->file_factory($game, 'media', ['chelsea', 'liverpool']); // add 2 media_content media files    
        }

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
                        'content_text',
                        'correct_answere',
                        'points_min',
                        'points_max',
                        'header' => [
                            '*' => [
                                'def',
                                'md',
                                'sm',
                                'thumb'
                            ]
                        ],
                        'media_content' => [
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
            ]);
    }

        /**
     * @test
     */
    public function can_return_all_games_of_type_text_answere_paginated()
    {
        //Given
        $games = $this->create_collection('Games\GameTextAnswere', [], false, $qty = 6);

        foreach($games as $game){
            $this->file_factory($game, 'header', ['chelsea', 'liverpool']); // add 2 header media files
            $this->file_factory($game, 'media', ['chelsea', 'liverpool']); // add 2 media_content media files    
        }

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
                        'content_text',
                        'correct_answere',
                        'points_min',
                        'points_max',
                        'header' => [
                            '*' => [
                                'def',
                                'md',
                                'sm',
                                'thumb'
                            ]
                        ],
                        'media_content' => [
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


    /**
     * @test
     */
    public function can_get_a_single_game_of_type_text_answere()
    {
        // Given
        $game = $this->create('Games\GameTextAnswere');

        // add 2 headers
        $this->file_factory($game, 'header', ['liverpool', 'chelsea']);
        // add 2 media contents
        $this->file_factory($game, 'media', ['liverpool', 'chelsea']);

        // When
        $result = $this->json('GET', "/api/games/text_answere/$game->id");

        // Then
        $result->assertStatus(200)
               ->assertExactJson([
                'data' => [
                    'id' => $game->id,
                    'title' => $game->title,
                    'content_text' => $game->content_text,
                    'correct_answere' => $game->correct_answere,
                    'points_min' => $game->points_min,
                    'points_max' => $game->points_max,
                    'header' => [
                        [
                            'def' => $game->getMedia('header')[0]->getUrl(),
                            'md' => $game->getMedia('header')[0]->getUrl('md'),
                            'sm' => $game->getMedia('header')[0]->getUrl('sm'),
                            'thumb' => $game->getMedia('header')[0]->getUrl('thumb'),
                        ],
                        [
                            'def' => $game->getMedia('header')[1]->getUrl(),
                            'md' => $game->getMedia('header')[1]->getUrl('md'),
                            'sm' => $game->getMedia('header')[1]->getUrl('sm'),
                            'thumb' => $game->getMedia('header')[1]->getUrl('thumb'),
                        ]
                    ],
                    'media_content' => [
                        [
                            'def' => $game->getMedia('media')[0]->getUrl(),
                            'md' => $game->getMedia('media')[0]->getUrl('md'),
                            'sm' => $game->getMedia('media')[0]->getUrl('sm'),
                            'thumb' => $game->getMedia('media')[0]->getUrl('thumb'),
                        ],
                        [
                            'def' => $game->getMedia('media')[1]->getUrl(),
                            'md' => $game->getMedia('media')[1]->getUrl('md'),
                            'sm' => $game->getMedia('media')[1]->getUrl('sm'),
                            'thumb' => $game->getMedia('media')[1]->getUrl('thumb'),
                        ]
                    ],
                    'created_at' => (string)$game->created_at
                ]
            ]);

    }

}

trait Post
{
    /**
     * @test
     */
    public function can_create_a_text_answere_game_with_a_valid_content_media()
    {
        $body = [
            'title' => 'dsfsdvafs',
            'content_text' => 'fas af afs asdasd as',
            'correct_answere' => 'fsadfafa fas as dfasdfas asdfas dfasfa das',
            'points_min' => 123423,
            'points_max' => 123456
        ];
        $files = [          
            'header' => [
                UploadedFile::fake()->image('liverpool.jpg'),
                UploadedFile::fake()->image('chelsea.jpg'),
            ],
            'media_content' => [
                UploadedFile::fake()->image('barcelona.jpg'),
                UploadedFile::fake()->image('juventus.jpg')
            ]
        ];

        $res = $this->json('POST', '/api/games/text_answere', array_merge($body, $files));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                        'title',
                        'content_text',
                        'correct_answere',
                        'points_min',
                        'points_max' ,
                        'header' => [
                            '*' => 
                            [
                                'def',
                                'md',
                                'sm',
                                'thumb'
                            ]
                        ],
                        'media_content' => [
                            '*' => 
                            [
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
        $this->assertDatabaseHas('game_text_answeres', $body);

        // assert if the files are uploaded to storage
        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->header)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }

        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->media_content)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
    }

    // Media are not uploaded directly with a game creation, instead they will be plucked from a local library (Media model)
    /**
     * @test
     */
    public function can_create_a_text_answere_game_without_media_of_type_header()
    {
        $body = [
            'title' => 'dsfsdvafs',
            'content_text' => 'fas af afs asdasd as',
            'correct_answere' => 'fsadfafa fas as dfasdfas asdfas dfasfa das',
            'points_min' => 123423,
            'points_max' => 123456
        ];
        $files = [          
            'media_content' => [
                UploadedFile::fake()->image('barcelona.jpg'),
                UploadedFile::fake()->image('juventus.jpg')
            ]
        ];

        $res = $this->json('POST', '/api/games/text_answere', array_merge($body, $files));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                        'title',
                        'content_text',
                        'correct_answere',
                        'points_min',
                        'points_max' ,
                        'header',
                        'media_content' => [
                            '*' => 
                            [
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
        $this->assertDatabaseHas('game_text_answeres', $body);

        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->header)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
        // assert if the files are uploaded to storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->media_content)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
    }

    /**
     * @test
     */
    public function can_create_a_text_answere_game_without_media_of_type_media()
    {
        $body = [
            'title' => 'dsfsdvafs',
            'content_text' => 'fas af afs asdasd as',
            'correct_answere' => 'fsadfafa fas as dfasdfas asdfas dfasfa das',
            'points_min' => 123423,
            'points_max' => 123456
        ];
        $files = [          
            'header' => [
                UploadedFile::fake()->image('liverpool.jpg'),
                UploadedFile::fake()->image('chelsea.jpg'),
            ],
            'media_content' => [
                UploadedFile::fake()->image('barcelona.jpg'),
                UploadedFile::fake()->image('juventus.jpg')
            ]
        ];

        $res = $this->json('POST', '/api/games/text_answere', array_merge($body, $files));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                        'title',
                        'content_text',
                        'correct_answere',
                        'points_min',
                        'points_max' ,
                        'header' => [
                            '*' => 
                            [
                                'def',
                                'md',
                                'sm',
                                'thumb'
                            ]
                        ],
                        'media_content',
                        'created_at'
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('game_text_answeres', $body);

        // assert if the files are uploaded to storage
        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->header)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }

        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->media_content)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
    }

    /**
     * @test
     */
    public function can_create_a_text_answere_game_without_any_media()
    {
        $body = [
            'title' => 'dsfsdvafs',
            'content_text' => 'fas af afs asdasd as',
            'correct_answere' => 'fsadfafa fas as dfasdfas asdfas dfasfa das',
            'points_min' => 123423,
            'points_max' => 123456
        ];

        $res = $this->json('POST', '/api/games/text_answere', $body);

        // Then
        $res->assertStatus(201)
             ->assertExactJson([
                'data' => [
                        'id' => $res->getData()->data->id,
                        'title' => $body['title'],
                        'content_text' => $body['content_text'],
                        'correct_answere' => $body['correct_answere'],
                        'points_min' => $body['points_min'],
                        'points_max' => $body['points_max'],
                        'header' => null,
                        'media_content' => null,
                        'created_at' => $res->getData()->data->created_at
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('game_text_answeres', $body);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_body_failed_validation_because_of_wrong_data_types()
    {
        // 'title' & 'points_min' are wrong data type
        $body_1 = [
            'title' => 1234,
            'content_text' => 'dsaakmcs',
            'correct_answere' => 'dsaakmcs',
            'points_min' => 'dsaakmcs',
            'points_max' => 12345
        ];
        $res = $this->json('POST', '/api/games/text_answere', $body_1);
        $res->assertStatus(422);
        $this->assertDatabaseMissing('game_text_answeres', $body_1);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_body_failed_validation_because_data_was_missing()
    {
        // 'points_min' is missing
        $body_2 = [
            'title' => 'sadasdff',
            'content_text' => 'dsaakmcs',
            'correct_answere' => 'dsaakmcs',
            'points_max' => 12345,
        ];
        $res = $this->json('POST', '/api/games/text_answere', $body_2);
        $res->assertStatus(422);
        $this->assertDatabaseMissing('game_text_answeres', $body_2);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_files_failed_validation_because_wrong_file_type()
    {
        $body = [
            'title' => 'fdhshuifhs fsdhui',
            'content_text' => 'dsj a uhdfg hfiughgifud hugfaidhiuagf ga',
            'correct_answere' => 'kjdfgh kjhfds hjd os ie is djojks.',
            'points_min' => 123456,
            'points_max' => 123458
        ];
        $files = [          
            'header' => [
                UploadedFile::fake()->image('liverpool.csv'),
                UploadedFile::fake()->image('chelsea.csv'),
            ],
            'media_content' => [
                UploadedFile::fake()->image('barcelona.csv'),
                UploadedFile::fake()->image('juventus.csv')
            ]
        ];

        $res = $this->json('POST', '/api/games/text_answere', array_merge($body, $files));

        // Then
        // Describes the outcome of Action according to conditions in Given
        $res->assertStatus(422);
        $this->assertDatabaseMissing('game_text_answeres', $body);
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
    // /**
    //  * @test
    //  */
    // public function will_fail_with_a_404_if_the_game_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/games/-1');
    //     $res->assertStatus(404);
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
}

trait Delete
{
    // /**
    //  * @test
    //  */
    // public function will_fail_with_a_404_if_the_game_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/games/-1');
    //     $res->assertStatus(404);
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
}