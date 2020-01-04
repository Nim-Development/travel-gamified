<?php

namespace Tests\Feature\Http\Controllers\Admin\Games\GameMultipleChoiceController;

use Faker\Factory;
use Tests\TestCase;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GameMultipleChoiceControllerTest extends TestCase
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
    public function returns_a_null_value_on_options_relationship_and_media_if_they_are_not_available()
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
                    'content_text' => $game->content_text,
                    'correct_answere' => $game->correct_answere,
                    'points_min' => $game->points_min,
                    'points_max' => $game->points_max,
                    'options' => null,
                    'header' => null,
                    'media_content' => null,
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

        foreach($games as $game){
            $this->file_factory($game, 'header', ['chelsea', 'liverpool']); // add 2 header media files
            $this->file_factory($game, 'media', ['chelsea', 'liverpool']); // add 2 media_content media files    
        }
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

        foreach($games as $game){
            $this->file_factory($game, 'header', ['chelsea', 'liverpool']); // add 2 header media files
            $this->file_factory($game, 'media', ['chelsea', 'liverpool']); // add 2 media_content media files    
        }

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
    public function can_get_a_single_GAME_of_type_multiple_choice()
    {
        // Given
        $game = $this->create('Games\GameMultipleChoice');

        // create 3 options and link them to $game
        $this->create_collection('Games\GameMultipleChoiceOption', ['game_id' => $game->id], true, $qty = 3);

        // add 2 headers
        $this->file_factory($game, 'header', ['liverpool', 'chelsea']);
        // add 2 media contents
        $this->file_factory($game, 'media', ['liverpool', 'chelsea']);

        // When
        $result = $this->json('GET', "/api/games/multiple_choice/$game->id");

        // Then
        $result->assertStatus(200)
               ->assertJsonCount(3, 'data.options')
               ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
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

trait Post
{

    /**
     * @test
     */
    public function can_create_a_multiple_choice_game_with_a_valid_content_media()
    {
        $body = [
            'title' => 'dsfsdvafs',
            'content_text' => 'fas af afs asdasd as',
            'correct_answere' => 'fsadfafa fas as dfasdfas asdfas dfasfa das',
            'points_min' => 123423,
            'points_max' => 123456
        ];
        $options = [
            'options' => [
                [
                    'sort_order' => 1,
                    'text' => 'ahuasdh uashd  ush ad'
                ],
                [
                    'sort_order' => 2,
                    'text' => 'jiad oiopwe jdsaij jj'
                ],
                [
                    'sort_order' => 3,
                    'text' =>  'poiio iosf us dufds uuus'
                ]
            ]
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

        $res = $this->json('POST', '/api/games/multiple_choice', array_merge(array_merge($body, $options), $files));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                        'title',
                        'content_text',
                        'correct_answere',
                        'points_min',
                        'points_max' ,
                        'options' => [
                            '*' => [
                                'id',
                                'sort_order',
                                'text',
                                'created_at'
                            ]
                        ],
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
        $this->assertDatabaseHas('game_multiple_choices', $body);

        // assert if each option has been added to the database
        foreach ($options['options'] as $option) {
            $this->assertDatabaseHas('game_multiple_choice_options',$option);
        }

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
    public function can_create_a_multiple_choice_game_without_media_of_type_header()
    {
        $body = [
            'title' => 'dsfsdvafs',
            'content_text' => 'fas af afs asdasd as',
            'correct_answere' => 'fsadfafa fas as dfasdfas asdfas dfasfa das',
            'points_min' => 123423,
            'points_max' => 123456
        ];
        $options = [
            'options' => [
                [
                    'sort_order' => 1,
                    'text' => 'ahuasdh uashd  ush ad'
                ],
                [
                    'sort_order' => 2,
                    'text' => 'jiad oiopwe jdsaij jj'
                ],
                [
                    'sort_order' => 3,
                    'text' =>  'poiio iosf us dufds uuus'
                ]
            ]
        ];
        $files = [          
            'media_content' => [
                UploadedFile::fake()->image('barcelona.jpg'),
                UploadedFile::fake()->image('juventus.jpg')
            ]
        ];

        $res = $this->json('POST', '/api/games/multiple_choice', array_merge(array_merge($body, $options), $files));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                        'title',
                        'content_text',
                        'correct_answere',
                        'points_min',
                        'points_max' ,
                        'options' => [
                            '*' => [
                                'id',
                                'sort_order',
                                'text',
                                'created_at'
                            ]
                        ],
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
        $this->assertDatabaseHas('game_multiple_choices', $body);

        // assert if each option has been added to the database
        foreach ($options['options'] as $option) {
            $this->assertDatabaseHas('game_multiple_choice_options',$option);
        }

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
    public function can_create_a_multiple_choice_game_without_media_of_type_media()
    {
        $body = [
            'title' => 'dsfsdvafs',
            'content_text' => 'fas af afs asdasd as',
            'correct_answere' => 'fsadfafa fas as dfasdfas asdfas dfasfa das',
            'points_min' => 123423,
            'points_max' => 123456
        ];
        $options = [
            'options' => [
                [
                    'sort_order' => 1,
                    'text' => 'ahuasdh uashd  ush ad'
                ],
                [
                    'sort_order' => 2,
                    'text' => 'jiad oiopwe jdsaij jj'
                ],
                [
                    'sort_order' => 3,
                    'text' =>  'poiio iosf us dufds uuus'
                ]
            ]
        ];
        $files = [          
            'header' => [
                UploadedFile::fake()->image('liverpool.jpg'),
                UploadedFile::fake()->image('chelsea.jpg'),
            ]
        ];

        $res = $this->json('POST', '/api/games/multiple_choice', array_merge(array_merge($body, $files), $options));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                        'title',
                        'content_text',
                        'correct_answere',
                        'points_min',
                        'points_max' ,
                        'options' => [
                            '*' => [
                                'id',
                                'sort_order',
                                'text',
                                'created_at'
                            ]
                        ],
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
        $this->assertDatabaseHas('game_multiple_choices', $body);

        // assert if each option has been added to the database
        foreach ($options['options'] as $option) {
            $this->assertDatabaseHas('game_multiple_choice_options',$option);
        }

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
    public function can_create_a_multiple_choice_game_without_any_media()
    {
        $body = [
            'title' => 'dsfsdvafs',
            'content_text' => 'fas af afs asdasd as',
            'correct_answere' => 'fsadfafa fas as dfasdfas asdfas dfasfa das',
            'points_min' => 123423,
            'points_max' => 123456
        ];

        $options = [
            'options' => [
                [
                    'sort_order' => 1,
                    'text' => 'ahuasdh uashd  ush ad'
                ],
                [
                    'sort_order' => 2,
                    'text' => 'jiad oiopwe jdsaij jj'
                ],
                [
                    'sort_order' => 3,
                    'text' =>  'poiio iosf us dufds uuus'
                ]
            ]
        ];

        $res = $this->json('POST', '/api/games/multiple_choice', array_merge($body, $options));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'title',
                    'content_text',
                    'correct_answere',
                    'points_min',
                    'points_max' ,
                    'options' => [
                        '*' => [
                            'id',
                            'sort_order',
                            'text',
                            'created_at'
                        ]
                    ],
                    'header', //null
                    'media_content', //null
                    'created_at'
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('game_multiple_choices', $body);

        // assert if each option has been added to the database
        foreach ($options['options'] as $option) {
            $this->assertDatabaseHas('game_multiple_choice_options',$option);
        }
    }

        /**
     * @test
     */
    public function can_create_a_multiple_choice_game_without_any_options()
    {
        $body = [
            'title' => 'dsfsdvafs',
            'content_text' => 'fas af afs asdasd as',
            'correct_answere' => 'fsadfafa fas as dfasdfas asdfas dfasfa das',
            'points_min' => 123423,
            'points_max' => 123456,
        ];

        $options = [
            'options' => null
        ];

        $res = $this->json('POST', '/api/games/multiple_choice', array_merge($body, $options));

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
                        'options' => null,
                        'header' => null,
                        'media_content' => null,
                        'created_at' => $res->getData()->data->created_at
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('game_multiple_choices', $body);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_body_failed_validation_because_of_wrong_data_types()
    {
        // 'title' & 'points_min' are wrong data type
        $body = [
            'title' => 1234,
            'content_text' => 'dsaakmcs',
            'correct_answere' => 'dsaakmcs',
            'points_min' => 'dsaakmcs',
            'points_max' => 12345
        ];
        $options = [
            'options' => [
                [
                    'sort_order' => 1,
                    'text' => 'ahuasdh uashd  ush ad'
                ],
                [
                    'sort_order' => 2,
                    'text' => 'jiad oiopwe jdsaij jj'
                ],
                [
                    'sort_order' => 3,
                    'text' =>  'poiio iosf us dufds uuus'
                ]
            ]
        ];
        
        $res = $this->json('POST', '/api/games/multiple_choice', array_merge($body, $options));
        $res->assertStatus(422);
        $this->assertDatabaseMissing('game_multiple_choices', $body);
        // assert if each option has been added to the database
        foreach ($options['options'] as $option) {
            $this->assertDatabaseMissing('game_multiple_choice_options', $option);
        }
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_body_failed_validation_because_data_was_missing()
    {
        // 'points_min' is missing
        $body = [
            'title' => 'sadasdff',
            'content_text' => 'dsaakmcs',
            'correct_answere' => 'dsaakmcs',
            'points_max' => 12345
        ];
        $options = [
            'options' => [
                [
                    'sort_order' => 1,
                    'text' => 'ahuasdh uashd  ush ad'
                ],
                [
                    'sort_order' => 2,
                    'text' => 'jiad oiopwe jdsaij jj'
                ],
                [
                    'sort_order' => 3,
                    'text' =>  'poiio iosf us dufds uuus'
                ]
            ]
        ];

        $res = $this->json('POST', '/api/games/multiple_choice', array_merge($body, $options));
        $res->assertStatus(422);
        $this->assertDatabaseMissing('game_multiple_choices', $body);

        // assert if the options are missing from the database
        foreach ($options['options'] as $option) {
            $this->assertDatabaseMissing('game_multiple_choice_options',$option);
        }
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
        $options = [
            'options' => [
                [
                    'sort_order' => 1,
                    'text' => 'ahuasdh uashd  ush ad'
                ],
                [
                    'sort_order' => 2,
                    'text' => 'jiad oiopwe jdsaij jj'
                ],
                [
                    'sort_order' => 3,
                    'text' =>  'poiio iosf us dufds uuus'
                ]
            ]
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

        $res = $this->json('POST', '/api/games/multiple_choice', array_merge(array_merge($body, $options), $files));

        // Then
        // Describes the outcome of Action according to conditions in Given
        $res->assertStatus(422);
        $this->assertDatabaseMissing('game_multiple_choices', $body);
        // assert if the options are missing from the database
        foreach ($options['options'] as $option) {
            $this->assertDatabaseMissing('game_multiple_choice_options',$option);
        }
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
    // public function will_fail_with_a_404_if_the_game_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/games/-1');
    //     $res->assertStatus(404);
    // }

    //     /**
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