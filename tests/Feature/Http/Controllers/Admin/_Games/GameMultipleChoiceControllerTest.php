<?php

namespace Tests\Feature\Http\Controllers\Admin\GameMultipleChoiceController;

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

    protected $api_base = "/api/admin/games/multiple_choice";


    /**
     * @test
     */
    // public function non_authenticated_user_can_not_access_game_api_endpoints()
    // {
    //     $this->json("GET", "/api/games")->assertStatus(401);
    //     $this->json("GET", "api/games/1")->assertStatus(401);
    //     $this->json("PUT", "api/games/1")->assertStatus(401);
    //     $this->json("DELETE", "api/games/1")->assertStatus(401);
    //     $this->json("POST", "/api/games")->assertStatus(401);
    // }
    
}

trait Get
{
  /**
     * @test
     */
    public function will_fail_with_a_404_if_game_of_type_multiple_choice_is_not_found()
    {
        $res = $this->json("GET", "$this->api_base/-1");
        $res->assertStatus(404);
    }

        /**
     * @test
     */
    public function will_fail_with_a_204_if_requesting_options_from_a_game_that_has_no_options()
    {
        $game = $this->create("GameMultipleChoice");
        $res = $this->json("GET", "$this->api_base/$game->id/options");
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_fail_with_a_204_if_requesting_paginated_options_from_database_but_there_are_no_options()
    {
        $res = $this->json("GET", "$this->api_base/options/paginate/1");
        $res->assertStatus(204);
    }

        /**
     * @test
     */
    public function will_fail_with_a_204_if_requesting_all_options_from_database_but_there_are_no_options()
    {
        $res = $this->json("GET", "$this->api_base/options");
        $res->assertStatus(204);
    }

        /**
     * @test
     */
    public function will_return_204_when_requesting_all_multiple_choice_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json("GET", "$this->api_base");
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_multiple_choice_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json("GET", "$this->api_base/paginate/3");
        $res->assertStatus(204);
    }



    /**
     * @test
     */
    public function returns_a_null_value_on_options_relationship_and_media_if_they_are_not_available()
    {
        // create game without options
        $game = $this->create("GameMultipleChoice");

        // When
        $result = $this->json("GET", "/$this->api_base/".$game->id);

        // Then
        $result->assertStatus(200)
            ->assertExactJson([
                "data" => [
                    "id" => $game->id,
                    "title" => $game->title,
                    "content_text" => $game->content_text,
                    "correct_answere" => $game->correct_answere,
                    "points_min" => $game->points_min,
                    "points_max" => $game->points_max,
                    "options" => null,
                    "header" => null,
                    "media_content" => null,
                    "created_at" => (string)$game->created_at
                ]
            ]);
    }


    /**
     * @test
     */
    public function can_get_all_GAMES_of_type_multiple_choice()
    {
        // Given
        $games = $this->create_collection("GameMultipleChoice", [], false, $qty = 6);

        // insert 3 options per game in collection
        $this->link_options_to_each_game_collection_item($games, 3);

        foreach($games as $game){
            $this->file_factory($game, "header", ["chelsea", "liverpool"]); // add 2 header media files
            $this->file_factory($game, "media", ["chelsea", "liverpool"]); // add 2 media_content media files    
        }
        // When
        $result = $this->json("GET", "/$this->api_base");

        // Then
        $result->assertStatus(200)
               ->assertJsonCount(6, "data")
               ->assertJsonStructure([
                "data" => [
                    "*" => [
                        "id",
                        "title",
                        "content_text",
                        "correct_answere",
                        "points_min",
                        "points_max",
                        "options" => [
                            "*" => [
                                "id",
                                "sort_order",
                                "text",
                                "created_at"
                            ]
                        ],
                        "header" => [
                            "*" => [
                                "def",
                                "md",
                                "sm",
                                "thumb"
                            ]
                        ],
                        "media_content" => [
                            "*" => [
                                "def",
                                "md",
                                "sm",
                                "thumb"
                            ]
                        ],
                        "created_at"
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
        $games = $this->create_collection("GameMultipleChoice", [], true, $qty = 6);

        // insert 3 options per game in collection
        $this->link_options_to_each_game_collection_item($games, 3);

        foreach($games as $game){
            $this->file_factory($game, "header", ["chelsea", "liverpool"]); // add 2 header media files
            $this->file_factory($game, "media", ["chelsea", "liverpool"]); // add 2 media_content media files    
        }

        // When
        $result = $this->json("GET", "/$this->api_base/paginate/3");

        // Then
        $result->assertStatus(200)
               ->assertJsonCount(3, "data")
               ->assertJsonStructure([
                "data" => [
                    "*" => [
                        "id",
                        "title",
                        "content_text",
                        "correct_answere",
                        "points_min",
                        "points_max",
                        "options" => [
                            "*" => [
                                "id",
                                "sort_order",
                                "text",
                                "created_at"
                            ]
                        ],
                        "header" => [
                            "*" => [
                                "def",
                                "md",
                                "sm",
                                "thumb"
                            ]
                        ],
                        "media_content" => [
                            "*" => [
                                "def",
                                "md",
                                "sm",
                                "thumb"
                            ]
                        ],
                        "created_at"
                    ]
                ],
                // Check if it is paginated
                "links" => ["first", "last", "prev", "next"],
                "meta" => [
                    "current_page", "last_page", "from", "to",
                    "path", "per_page", "total"
                ]
            ]);
    }

    /**
     * @test
     */
    public function can_get_a_single_GAME_of_type_multiple_choice()
    {
        // Given
        $game = $this->create("GameMultipleChoice");

        // create 3 options and link them to $game
        $this->create_collection("GameMultipleChoiceOption", ["game_id" => $game->id], true, $qty = 3);

        // add 2 headers
        $this->file_factory($game, "header", ["liverpool", "chelsea"]);
        // add 2 media contents
        $this->file_factory($game, "media", ["liverpool", "chelsea"]);

        // When
        $result = $this->json("GET", "/$this->api_base/$game->id");

        // Then
        $result->assertStatus(200)
               ->assertJsonCount(3, "data.options")
               ->assertJsonStructure([
                "data" => [
                    "id",
                    "title",
                    "content_text",
                    "correct_answere",
                    "points_min",
                    "points_max",
                    "options" => [
                        "*" => [
                            "id",
                            "sort_order",
                            "text",
                            "created_at"
                        ]
                    ],
                    "header" => [
                        "*" => 
                        [
                            "def",
                            "md",
                            "sm",
                            "thumb"
                        ]
                    ],
                    "media_content" => [
                        "*" => 
                        [
                            "def",
                            "md",
                            "sm",
                            "thumb"
                        ]
                    ],
                    "created_at"
                ]
            ]);
    }

    /**
     * @test
     */
    public function can_return_all_multiple_choice_game_OPTIONS()
    {

        // Given, multiple multiple choice options
        $this->create_collection("GameMultipleChoiceOption", [], true, $qty = 6);

        // When
        $result = $this->json("GET", "/$this->api_base/options");
        // Then
        $result->assertStatus(200)
               ->assertJsonCount(6, "data")
               ->assertJsonStructure([
                "data" => [
                    "*" => ["id","game_id", "sort_order", "text","created_at"]
                ],
            ]);
    }

        /**
     * @test
     */
    public function can_return_all_multiple_choice_game_OPTIONS_paginated()
    {
        // Given, multiple multiple choice options
        $this->create_collection("GameMultipleChoiceOption", [], true, $qty = 6);

        // When
        $result = $this->json("GET", "/$this->api_base/options/paginate/3");

        // Then
        $result->assertStatus(200)
               ->assertJsonCount(3, "data")
               ->assertJsonStructure([
                "data" => [
                    "*" => ["id","game_id", "sort_order", "text","created_at"]
                ],
                // Check if it is paginated
                "links" => ["first", "last", "prev", "next"],
                "meta" => [
                    "current_page", "last_page", "from", "to",
                    "path", "per_page", "total"
                ]
            ]);
    }

    /**
     * @test
     */
    public function get_OPTIONS_from_a_single_multiple_choice_game()
    {

        // Given
        $game = $this->create("GameMultipleChoice");

        // make 3 options and bind them to $game by game_id
        $this->create_collection("GameMultipleChoiceOption", ["game_id" => $game->id], true, $qty = 3);

        // When
        $result = $this->json("GET", "/$this->api_base/$game->id/options");

        // Then
        $result->assertStatus(200)
               ->assertJsonCount(3, "data")
               ->assertJsonStructure([
                "data" => [
                    "*" => ["id", "game_id", "sort_order", "text","created_at"]
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
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
            "points_min" => 123423,
            "points_max" => 123456
        ];
        $options = [
            "options" => [
                [
                    "sort_order" => 1,
                    "text" => "ahuasdh uashd  ush ad"
                ],
                [
                    "sort_order" => 2,
                    "text" => "jiad oiopwe jdsaij jj"
                ],
                [
                    "sort_order" => 3,
                    "text" =>  "poiio iosf us dufds uuus"
                ]
            ]
        ];
        $files = [          
            "header" => [
                UploadedFile::fake()->image("liverpool.jpg"),
                UploadedFile::fake()->image("chelsea.jpg"),
            ],
            "media_content" => [
                UploadedFile::fake()->image("barcelona.jpg"),
                UploadedFile::fake()->image("juventus.jpg")
            ]
        ];

        $res = $this->json("POST", "/$this->api_base", array_merge(array_merge($body, $options), $files));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                "data" => [
                        "title",
                        "content_text",
                        "correct_answere",
                        "points_min",
                        "points_max" ,
                        "options" => [
                            "*" => [
                                "id",
                                "sort_order",
                                "text",
                                "created_at"
                            ]
                        ],
                        "header" => [
                            "*" => 
                            [
                                "def",
                                "md",
                                "sm",
                                "thumb"
                            ]
                        ],
                        "media_content" => [
                            "*" => 
                            [
                                "def",
                                "md",
                                "sm",
                                "thumb"
                            ]
                        ],
                        "created_at"
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas("game_multiple_choices", $body);

        // assert if each option has been added to the database
        foreach ($options["options"] as $option) {
            $this->assertDatabaseHas("game_multiple_choice_options",$option);
        }

        // assert if the files are uploaded to storage
        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->header)){
            \Storage::disk("test")->assertExists($stored_header_files_array);
        }

        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->media_content)){
            \Storage::disk("test")->assertExists($stored_header_files_array);
        }
    }

    // Media are not uploaded directly with a game creation, instead they will be plucked from a local library (Media model)
    /**
     * @test
     */
    public function can_create_a_multiple_choice_game_without_media_of_type_header()
    {
        $body = [
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
            "points_min" => 123423,
            "points_max" => 123456
        ];
        $options = [
            "options" => [
                [
                    "sort_order" => 1,
                    "text" => "ahuasdh uashd  ush ad"
                ],
                [
                    "sort_order" => 2,
                    "text" => "jiad oiopwe jdsaij jj"
                ],
                [
                    "sort_order" => 3,
                    "text" =>  "poiio iosf us dufds uuus"
                ]
            ]
        ];
        $files = [          
            "media_content" => [
                UploadedFile::fake()->image("barcelona.jpg"),
                UploadedFile::fake()->image("juventus.jpg")
            ]
        ];

        $res = $this->json("POST", "/$this->api_base", array_merge(array_merge($body, $options), $files));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                "data" => [
                        "title",
                        "content_text",
                        "correct_answere",
                        "points_min",
                        "points_max" ,
                        "options" => [
                            "*" => [
                                "id",
                                "sort_order",
                                "text",
                                "created_at"
                            ]
                        ],
                        "header",
                        "media_content" => [
                            "*" => 
                            [
                                "def",
                                "md",
                                "sm",
                                "thumb"
                            ]
                        ],
                        "created_at"
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas("game_multiple_choices", $body);

        // assert if each option has been added to the database
        foreach ($options["options"] as $option) {
            $this->assertDatabaseHas("game_multiple_choice_options",$option);
        }

        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->header)){
            \Storage::disk("test")->assertExists($stored_header_files_array);
        }
        // assert if the files are uploaded to storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->media_content)){
            \Storage::disk("test")->assertExists($stored_header_files_array);
        }
    }

    /**
     * @test
     */
    public function can_create_a_multiple_choice_game_without_media_of_type_media()
    {
        $body = [
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
            "points_min" => 123423,
            "points_max" => 123456
        ];
        $options = [
            "options" => [
                [
                    "sort_order" => 1,
                    "text" => "ahuasdh uashd  ush ad"
                ],
                [
                    "sort_order" => 2,
                    "text" => "jiad oiopwe jdsaij jj"
                ],
                [
                    "sort_order" => 3,
                    "text" =>  "poiio iosf us dufds uuus"
                ]
            ]
        ];
        $files = [          
            "header" => [
                UploadedFile::fake()->image("liverpool.jpg"),
                UploadedFile::fake()->image("chelsea.jpg"),
            ]
        ];

        $res = $this->json("POST", "/$this->api_base", array_merge(array_merge($body, $files), $options));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                "data" => [
                        "title",
                        "content_text",
                        "correct_answere",
                        "points_min",
                        "points_max" ,
                        "options" => [
                            "*" => [
                                "id",
                                "sort_order",
                                "text",
                                "created_at"
                            ]
                        ],
                        "header" => [
                            "*" => 
                            [
                                "def",
                                "md",
                                "sm",
                                "thumb"
                            ]
                        ],
                        "media_content",
                        "created_at"
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas("game_multiple_choices", $body);

        // assert if each option has been added to the database
        foreach ($options["options"] as $option) {
            $this->assertDatabaseHas("game_multiple_choice_options",$option);
        }

        // assert if the files are uploaded to storage
        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->header)){
            \Storage::disk("test")->assertExists($stored_header_files_array);
        }

        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->media_content)){
            \Storage::disk("test")->assertExists($stored_header_files_array);
        }
    }

    /**
     * @test
     */
    public function can_create_a_multiple_choice_game_without_any_media()
    {
        $body = [
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
            "points_min" => 123423,
            "points_max" => 123456
        ];

        $options = [
            "options" => [
                [
                    "sort_order" => 1,
                    "text" => "ahuasdh uashd  ush ad"
                ],
                [
                    "sort_order" => 2,
                    "text" => "jiad oiopwe jdsaij jj"
                ],
                [
                    "sort_order" => 3,
                    "text" =>  "poiio iosf us dufds uuus"
                ]
            ]
        ];

        $res = $this->json("POST", "/$this->api_base", array_merge($body, $options));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                "data" => [
                    "title",
                    "content_text",
                    "correct_answere",
                    "points_min",
                    "points_max" ,
                    "options" => [
                        "*" => [
                            "id",
                            "sort_order",
                            "text",
                            "created_at"
                        ]
                    ],
                    "header", //null
                    "media_content", //null
                    "created_at"
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas("game_multiple_choices", $body);

        // assert if each option has been added to the database
        foreach ($options["options"] as $option) {
            $this->assertDatabaseHas("game_multiple_choice_options",$option);
        }
    }

        /**
     * @test
     */
    public function can_create_a_multiple_choice_game_without_any_options()
    {
        $body = [
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
            "points_min" => 123423,
            "points_max" => 123456,
        ];

        $options = [
            "options" => null
        ];

        $res = $this->json("POST", "/$this->api_base", array_merge($body, $options));

        // Then
        $res->assertStatus(201)
             ->assertExactJson([
                "data" => [
                        "id" => $res->getData()->data->id,
                        "title" => $body["title"],
                        "content_text" => $body["content_text"],
                        "correct_answere" => $body["correct_answere"],
                        "points_min" => $body["points_min"],
                        "points_max" => $body["points_max"],
                        "options" => null,
                        "header" => null,
                        "media_content" => null,
                        "created_at" => $res->getData()->data->created_at
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas("game_multiple_choices", $body);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_body_failed_validation_because_of_wrong_data_types()
    {
        // "title" & "points_min" are wrong data type
        $body = [
            "title" => 1234,
            "content_text" => "dsaakmcs",
            "correct_answere" => "dsaakmcs",
            "points_min" => "dsaakmcs",
            "points_max" => 12345
        ];
        $options = [
            "options" => [
                [
                    "sort_order" => 1,
                    "text" => "ahuasdh uashd  ush ad"
                ],
                [
                    "sort_order" => 2,
                    "text" => "jiad oiopwe jdsaij jj"
                ],
                [
                    "sort_order" => 3,
                    "text" =>  "poiio iosf us dufds uuus"
                ]
            ]
        ];
        
        $res = $this->json("POST", "/$this->api_base", array_merge($body, $options));
        $res->assertStatus(422);
        $this->assertDatabaseMissing("game_multiple_choices", $body);
        // assert if each option has been added to the database
        foreach ($options["options"] as $option) {
            $this->assertDatabaseMissing("game_multiple_choice_options", $option);
        }
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_body_failed_validation_because_data_was_missing()
    {
        // "points_min" is missing
        $body = [
            "title" => "sadasdff",
            "content_text" => "dsaakmcs",
            "correct_answere" => "dsaakmcs",
            "points_max" => 12345
        ];
        $options = [
            "options" => [
                [
                    "sort_order" => 1,
                    "text" => "ahuasdh uashd  ush ad"
                ],
                [
                    "sort_order" => 2,
                    "text" => "jiad oiopwe jdsaij jj"
                ],
                [
                    "sort_order" => 3,
                    "text" =>  "poiio iosf us dufds uuus"
                ]
            ]
        ];

        $res = $this->json("POST", "/$this->api_base", array_merge($body, $options));
        $res->assertStatus(422);
        $this->assertDatabaseMissing("game_multiple_choices", $body);

        // assert if the options are missing from the database
        foreach ($options["options"] as $option) {
            $this->assertDatabaseMissing("game_multiple_choice_options",$option);
        }
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_files_failed_validation_because_wrong_file_type()
    {
        $body = [
            "title" => "fdhshuifhs fsdhui",
            "content_text" => "dsj a uhdfg hfiughgifud hugfaidhiuagf ga",
            "correct_answere" => "kjdfgh kjhfds hjd os ie is djojks.",
            "points_min" => 123456,
            "points_max" => 123458
        ];
        $options = [
            "options" => [
                [
                    "sort_order" => 1,
                    "text" => "ahuasdh uashd  ush ad"
                ],
                [
                    "sort_order" => 2,
                    "text" => "jiad oiopwe jdsaij jj"
                ],
                [
                    "sort_order" => 3,
                    "text" =>  "poiio iosf us dufds uuus"
                ]
            ]
        ];
        $files = [          
            "header" => [
                UploadedFile::fake()->image("liverpool.csv"),
                UploadedFile::fake()->image("chelsea.csv"),
            ],
            "media_content" => [
                UploadedFile::fake()->image("barcelona.csv"),
                UploadedFile::fake()->image("juventus.csv")
            ]
        ];

        $res = $this->json("POST", "/$this->api_base", array_merge(array_merge($body, $options), $files));

        // Then
        // Describes the outcome of Action according to conditions in Given
        $res->assertStatus(422);
        $this->assertDatabaseMissing("game_multiple_choices", $body);
        // assert if the options are missing from the database
        foreach ($options["options"] as $option) {
            $this->assertDatabaseMissing("game_multiple_choice_options",$option);
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
    /**
     * @test
     */
    public function will_fail_with_a_404_if_the_multiple_choice_game_we_want_to_update_is_not_found()
    {
        $res = $this->json("PUT", "$this->api_base/-1");
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_add_a_header_image_to_end_of_media_collection_from_game_multiple_choice()
    {
        // Given
        $old_values = [
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
            "points_min" => 123423,
            "points_max" => 123456
        ];

        $old_game = $this->create("GameMultipleChoice", $old_values);

        // attach media
        $this->file_factory($old_game, "header", ["header1", "header2"]);
        
        $files = [
            "header" => [
                UploadedFile::fake()->image("header3.jpg"),
                UploadedFile::fake()->image("header4.jpg"),
            ]
        ];

        // When
        $res = $this->json("PUT","$this->api_base/".$old_game->id, $files);

        // Then
        $res->assertStatus(200)
                    ->assertJsonCount(4, "data.header"); // assert that 2 images have been added to header

        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->header)){
            \Storage::disk("test")->assertExists($stored_header_files_array);
        }
    }
    
    /**
     * @test
     */
    public function can_add_a_media_image_to_end_of_media_collection_from_game_multiple_choice()
    {
        // Given
        $old_values = [
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
            "points_min" => 123423,
            "points_max" => 123456
        ];

        $old_game = $this->create("GameMultipleChoice", $old_values);

        // attach media
        $this->file_factory($old_game, "media", ["media1", "media2"]);
        
        $files = [
            "media_content" => [
                UploadedFile::fake()->image("media3.jpg"),
                UploadedFile::fake()->image("media4.jpg"),
            ]
        ];

        // When
        $res = $this->json("PUT","$this->api_base/".$old_game->id, $files);


        // Then
        $res->assertStatus(200)
                    ->assertJsonCount(4, "data.media_content"); // assert that 2 images have been added to header
                    
        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->media_content)){
            \Storage::disk("test")->assertExists($stored_header_files_array);
        }
    }

    /**
     * @test
     */
    public function can_update_game_multiple_choice_fully_on_each_model_attribute()
    {

        // Given
        $old_values = [
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
            "points_min" => 123423,
            "points_max" => 123456
        ];

        $old_game = $this->create("GameMultipleChoice", $old_values);

        // update every attribute
        $new_values = [
            "title" => "aaaaaaa",
            "content_text" => "aaaa aaaaa aaaaa",
            "correct_answere" => "aaa aaaa aaaaa aaaaa",
            "points_min" => 000001,
            "points_max" => 000002
        ];

        // When
        $response = $this->json("PUT","$this->api_base/".$old_game->id, $new_values);

        // Then
        $response->assertStatus(200)
                    ->assertJsonFragment($new_values);
                    
        $this->assertDatabaseHas("game_multiple_choices", $new_values);
        $this->assertDatabaseMissing("game_multiple_choices", $old_values);
            
    }
   
    /**
     * @test
     */
    public function can_update_game_multiple_choice_on_a_couple_of_model_attributes()
    {
        
        // Given
        $old_values_to_be_updated = [
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
        ];

        $old_values_to_remain_after_update = [
            "points_min" => 123423,
            "points_max" => 123456
        ];

        $old_game = $this->create("GameMultipleChoice", array_merge($old_values_to_be_updated, $old_values_to_remain_after_update));

        // update every attribute
        $new_values = [
            "title" => "aaaaaaa",
            "content_text" => "aaaaaaa",
            "correct_answere" => "aaaaaaaa",
        ];

        // When
        $response = $this->json("PUT","$this->api_base/".$old_game->id, $new_values);

        // Then
        $response->assertStatus(200)
                    ->assertJsonFragment(array_merge($new_values, $old_values_to_remain_after_update));
                    
        $this->assertDatabaseHas("game_multiple_choices", array_merge($new_values, $old_values_to_remain_after_update));
        $this->assertDatabaseMissing("game_multiple_choices", $old_values_to_be_updated);

    }


    /**
     * @test
     */
    public function can_add_options_to_the_end_of_relational_options()
    {
        // Given
        $old_values = [
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
            "points_min" => 123423,
            "points_max" => 123456
        ];

        $old_game = $this->create("GameMultipleChoice", $old_values);
        
        // create 3 options and link them to $game
        $this->create_collection("GameMultipleChoiceOption", ["game_id" => $old_game->id], false, 2);
        

        $options = [
            "options" => [
                [
                    "sort_order" => 1,
                    "text" => "ahuasdh uashd  ush ad"
                ],
                [
                    "sort_order" => 2,
                    "text" => "jiad oiopwe jdsaij jj"
                ]
            ]
        ];

        // When
        $res = $this->json("PUT","$this->api_base/".$old_game->id, $options);

        // Then
        $res->assertStatus(200)
                    ->assertJsonCount(4, "data.options"); // assert that 2 options have been added

    }


    /**
     * @test
     */
    public function will_fail_with_422_if_data_is_missing_from_options()
    {
        // Given
        $old_values = [
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
            "points_min" => 123423,
            "points_max" => 123456
        ];

        $old_game = $this->create("GameMultipleChoice", $old_values);
        
        // create 3 options and link them to $game
        $this->create_collection("GameMultipleChoiceOption", ["game_id" => $old_game->id], false, 2);
        

        // "sort_order" is missing
        $options = [
            "options" => [
                [
                    "text" => "ahuasdh uashd  ush ad"
                ],
                [
                    "sort_order" => 0,
                    "text" => "jiad oiopwe jdsaij jj"
                ]
            ]
        ];

        // When
        $res = $this->json("PUT","$this->api_base/".$old_game->id, $options);

        // Then
        $res->assertStatus(422);
    }


    /**
     * @test
     */
    public function will_fail_with_error_422_when_body_data_is_of_wrong_type()
    {
        // Given
        $old_values = [
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
            "points_min" => 123423,
            "points_max" => 123456
        ];

        $old_game = $this->create("GameMultipleChoice", $old_values);

        // "title" is of wrong type
        $new_values = [
            "title" => 1234567,
            "content_text" => "aaaa aaaaa aaaaa",
            "correct_answere" => "aaa aaaa aaaaa aaaaa",
            "points_min" => 000001,
            "points_max" => 000002
        ];

        // When
        $response = $this->json("PUT","$this->api_base/".$old_game->id, $new_values);

        // Then
        $response->assertStatus(422);

        $this->assertDatabaseHas("game_multiple_choices", $old_values);          
        $this->assertDatabaseMissing("game_multiple_choices", $new_values);

    }
}

trait Delete
{
    /**
     * @test
     */
    public function will_fail_with_a_404_if_the_game_multiple_choice_we_want_to_delete_is_not_found()
    {
        $res = $this->json("DELETE", "$this->api_base/-1");
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_delete_a_game_multiple_choice_including_its_files()
    {
        // Given
        // first create a game in the database to delete
        $game = $this->create("GameMultipleChoice");

        // attach media
        $media = ["media1", "media2"];
        $this->file_factory($game, "media", $media);
        // attach media
        $header = ["header1", "header2"];
        $this->file_factory($game, "header", $header);

        // When
        // call the delete api
        $res = $this->json("DELETE", "/$this->api_base/".$game->id);

        // Then
        $res->assertStatus(204)
            ->assertSee(null);

        // check if $game is deleted from database
        $this->assertDatabaseMissing("game_multiple_choices", ["id" => $game->id]);

        \Storage::disk("test")->assertMissing($media);
        \Storage::disk("test")->assertMissing($header);

    }


        /**
     * @test
     */
    public function foreign_poly_relationship_is_set_to_null_after_delete()
    {
        // Given
        // first create a game in the database to delete
        $game = $this->create("GameMultipleChoice");

        // holds the polymoprhic relationship type and key
        $challenge = $this->create("Challenge", [
            "game_type" => "multiple_choice",
            "game_id" =>  $game->id
        ]);
        
        // When
        // call the delete api
        $res = $this->json("DELETE", "/$this->api_base/".$game->id);

        // Then
        $res->assertStatus(204)
            ->assertSee(null);

        // check if $game is deleted from database
        $this->assertDatabaseMissing("game_multiple_choices", ["id" => $game->id]);


        // refresh the poly relation from database
        $challenge->refresh();

        // check if polymorphic keys have been set to null
        if(!$challenge->game_type && !$challenge->game_id){
            // game_type and game_id have been set to NULL !
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }
    }

            /**
     * @test
     */
    public function relational_options_are_set_to_null_after_delete()
    {
        // Given
        // first create a game in the database to delete
        $game = $this->create("GameMultipleChoice");

        // holds the polymoprhic relationship type and key
        $options = $this->create_collection("GameMultipleChoiceOption", [
            "game_id" =>  $game->id
        ], false, 3);
        
        // When
        // call the delete api
        $res = $this->json("DELETE", "/$this->api_base/".$game->id);

        // Then
        $res->assertStatus(204)
            ->assertSee(null);

        // check if $game is deleted from database
        $this->assertDatabaseMissing("game_multiple_choices", ["id" => $game->id]);

        
        // assert if game_id of all previously relational options have been set to null.
        foreach($options as $option){
            $option->refresh();
            if(!$option->game_id){
                $this->assertTrue(true);
            }else{
                $this->assertTrue(false);
            }
        }
    }
}