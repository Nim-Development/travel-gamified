<?php

namespace Tests\Feature\Http\Controllers\Admin\GameTextAnswereController;

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

    protected $api_base = "/api/admin/games/text_answere";

    /**
     * @test
     */
    public function non_authenticated_user_can_not_access_game_api_endpoints()
    {
        $this->json("GET", "$this->api_base")->assertStatus(401);
        $this->json("GET", "$this->api_base/paginate/10")->assertStatus(401);
        $this->json("PUT", "$this->api_base/1")->assertStatus(401);
        $this->json("DELETE", "$this->api_base/1")->assertStatus(401);
        $this->json("POST", "$this->api_base")->assertStatus(401);
    }
}

trait Get
{
    /**
     * @test
     */
    public function will_fail_with_a_404_if_game_of_type_text_answere_is_not_found()
    {
        $this->create_user('admin');
        $this->create_user('admin');
        $res = $this->json("GET", "$this->api_base/-1");
        $res->assertStatus(404);
    }

        /**
     * @test
     */
    public function will_return_204_when_requesting_all_text_answere_whilst_no_entries_in_database()
    {
        $this->create_user('admin');
        // Skip any creates
        $res = $this->json("GET", "$this->api_base");
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_text_answere_whilst_no_entries_in_database()
    {
        $this->create_user('admin');
        // Skip any creates
        $res = $this->json("GET", "$this->api_base/paginate/3");
        $res->assertStatus(204);
    }



    /**
     * @test
     */
    public function can_return_all_games_of_type_text_answere()
    {
        $this->create_user('admin');
        // Given, multiple multiple choice options
        $games = $this->create_collection("GameTextAnswere", [], true, $qty = 6);

        foreach($games as $game){
            $this->file_factory($game, "header", ["chelsea", "liverpool"]); // add 2 header media files
            $this->file_factory($game, "media", ["chelsea", "liverpool"]); // add 2 media media files    
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
                        "header" => [
                            "*" => [
                                "def",
                                "md",
                                "sm",
                                "thumb"
                            ]
                        ],
                        "media" => [
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
            ]);
    }

        /**
     * @test
     */
    public function can_return_all_games_of_type_text_answere_paginated()
    {
        $this->create_user('admin');
        //Given
        $games = $this->create_collection("GameTextAnswere", [], false, $qty = 6);

        foreach($games as $game){
            $this->file_factory($game, "header", ["chelsea", "liverpool"]); // add 2 header media files
            $this->file_factory($game, "media", ["chelsea", "liverpool"]); // add 2 media media files    
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
                        "header" => [
                            "*" => [
                                "def",
                                "md",
                                "sm",
                                "thumb"
                            ]
                        ],
                        "media" => [
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
    public function can_get_a_single_game_of_type_text_answere()
    {
        $this->create_user('admin');
        // Given
        $game = $this->create("GameTextAnswere");

        // add 2 headers
        $this->file_factory($game, "header", ["liverpool", "chelsea"]);
        // add 2 media contents
        $this->file_factory($game, "media", ["liverpool", "chelsea"]);

        // When
        $result = $this->json("GET", "/$this->api_base/$game->id");

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
                    "header" => [
                        [
                            "def" => $game->getMedia("header")[0]->getUrl(),
                            "md" => $game->getMedia("header")[0]->getUrl("md"),
                            "sm" => $game->getMedia("header")[0]->getUrl("sm"),
                            "thumb" => $game->getMedia("header")[0]->getUrl("thumb"),
                        ],
                        [
                            "def" => $game->getMedia("header")[1]->getUrl(),
                            "md" => $game->getMedia("header")[1]->getUrl("md"),
                            "sm" => $game->getMedia("header")[1]->getUrl("sm"),
                            "thumb" => $game->getMedia("header")[1]->getUrl("thumb"),
                        ]
                    ],
                    "media" => [
                        [
                            "def" => $game->getMedia("media")[0]->getUrl(),
                            "md" => $game->getMedia("media")[0]->getUrl("md"),
                            "sm" => $game->getMedia("media")[0]->getUrl("sm"),
                            "thumb" => $game->getMedia("media")[0]->getUrl("thumb"),
                        ],
                        [
                            "def" => $game->getMedia("media")[1]->getUrl(),
                            "md" => $game->getMedia("media")[1]->getUrl("md"),
                            "sm" => $game->getMedia("media")[1]->getUrl("sm"),
                            "thumb" => $game->getMedia("media")[1]->getUrl("thumb"),
                        ]
                    ],
                    "created_at" => (string)$game->created_at
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
        $this->create_user('admin');
        $body = [
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
            "points_min" => 123423,
            "points_max" => 123456
        ];
        $files = [          
            "header" => [
                UploadedFile::fake()->image("liverpool.jpg"),
                UploadedFile::fake()->image("chelsea.jpg"),
            ],
            "media" => [
                UploadedFile::fake()->image("barcelona.jpg"),
                UploadedFile::fake()->image("juventus.jpg")
            ]
        ];

        $res = $this->json("POST", "/$this->api_base", array_merge($body, $files));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                "data" => [
                        "title",
                        "content_text",
                        "correct_answere",
                        "points_min",
                        "points_max" ,
                        "header" => [
                            "*" => 
                            [
                                "def",
                                "md",
                                "sm",
                                "thumb"
                            ]
                        ],
                        "media" => [
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
        $this->assertDatabaseHas("game_text_answeres", $body);

        // assert if the files are uploaded to storage
        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->header)){
            \Storage::disk("test")->assertExists($stored_header_files_array);
        }

        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->media)){
            \Storage::disk("test")->assertExists($stored_header_files_array);
        }
    }

    // Media are not uploaded directly with a game creation, instead they will be plucked from a local library (Media model)
    /**
     * @test
     */
    public function can_create_a_text_answere_game_without_media_of_type_header()
    {
        $this->create_user('admin');
        $body = [
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
            "points_min" => 123423,
            "points_max" => 123456
        ];
        $files = [          
            "media" => [
                UploadedFile::fake()->image("barcelona.jpg"),
                UploadedFile::fake()->image("juventus.jpg")
            ]
        ];

        $res = $this->json("POST", "/$this->api_base", array_merge($body, $files));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                "data" => [
                        "title",
                        "content_text",
                        "correct_answere",
                        "points_min",
                        "points_max" ,
                        "header",
                        "media" => [
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
        $this->assertDatabaseHas("game_text_answeres", $body);

        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->header)){
            \Storage::disk("test")->assertExists($stored_header_files_array);
        }
        // assert if the files are uploaded to storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->media)){
            \Storage::disk("test")->assertExists($stored_header_files_array);
        }
    }

    /**
     * @test
     */
    public function can_create_a_text_answere_game_without_media_of_type_media()
    {
        $this->create_user('admin');
        $body = [
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
            "points_min" => 123423,
            "points_max" => 123456
        ];
        $files = [          
            "header" => [
                UploadedFile::fake()->image("liverpool.jpg"),
                UploadedFile::fake()->image("chelsea.jpg"),
            ],
            "media" => [
                UploadedFile::fake()->image("barcelona.jpg"),
                UploadedFile::fake()->image("juventus.jpg")
            ]
        ];

        $res = $this->json("POST", "/$this->api_base", array_merge($body, $files));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                "data" => [
                        "title",
                        "content_text",
                        "correct_answere",
                        "points_min",
                        "points_max" ,
                        "header" => [
                            "*" => 
                            [
                                "def",
                                "md",
                                "sm",
                                "thumb"
                            ]
                        ],
                        "media",
                        "created_at"
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas("game_text_answeres", $body);

        // assert if the files are uploaded to storage
        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->header)){
            \Storage::disk("test")->assertExists($stored_header_files_array);
        }

        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->media)){
            \Storage::disk("test")->assertExists($stored_header_files_array);
        }
    }

    /**
     * @test
     */
    public function can_create_a_text_answere_game_without_any_media()
    {
        $this->create_user('admin');
        $body = [
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
            "points_min" => 123423,
            "points_max" => 123456
        ];

        $res = $this->json("POST", "/$this->api_base", $body);

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
                        "header" => null,
                        "media" => null,
                        "created_at" => $res->getData()->data->created_at
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas("game_text_answeres", $body);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_body_failed_validation_because_of_wrong_data_types()
    {
        $this->create_user('admin');
        // "title" & "points_min" are wrong data type
        $body_1 = [
            "title" => 1234,
            "content_text" => "dsaakmcs",
            "correct_answere" => "dsaakmcs",
            "points_min" => "dsaakmcs",
            "points_max" => 12345
        ];
        $res = $this->json("POST", "/$this->api_base", $body_1);
        $res->assertStatus(422);
        $this->assertDatabaseMissing("game_text_answeres", $body_1);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_body_failed_validation_because_data_was_missing()
    {
        $this->create_user('admin');
        // "points_min" is missing
        $body_2 = [
            "title" => "sadasdff",
            "content_text" => "dsaakmcs",
            "correct_answere" => "dsaakmcs",
            "points_max" => 12345,
        ];
        $res = $this->json("POST", "/$this->api_base", $body_2);
        $res->assertStatus(422);
        $this->assertDatabaseMissing("game_text_answeres", $body_2);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_files_failed_validation_because_wrong_file_type()
    {
        $this->create_user('admin');
        $body = [
            "title" => "fdhshuifhs fsdhui",
            "content_text" => "dsj a uhdfg hfiughgifud hugfaidhiuagf ga",
            "correct_answere" => "kjdfgh kjhfds hjd os ie is djojks.",
            "points_min" => 123456,
            "points_max" => 123458
        ];
        $files = [          
            "header" => [
                UploadedFile::fake()->image("liverpool.csv"),
                UploadedFile::fake()->image("chelsea.csv"),
            ],
            "media" => [
                UploadedFile::fake()->image("barcelona.csv"),
                UploadedFile::fake()->image("juventus.csv")
            ]
        ];

        $res = $this->json("POST", "/$this->api_base", array_merge($body, $files));

        // Then
        // Describes the outcome of Action according to conditions in Given
        $res->assertStatus(422);
        $this->assertDatabaseMissing("game_text_answeres", $body);
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
    public function will_fail_with_a_404_if_the_text_answere_game_we_want_to_update_is_not_found()
    {
        $this->create_user('admin');
        $res = $this->json("PUT", "$this->api_base/-1");
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_add_a_header_image_to_end_of_media_collection_from_game_text_answere()
    {
        $this->create_user('admin');
        // Given
        $old_values = [
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
            "points_min" => 123423,
            "points_max" => 123456
        ];

        $old_game = $this->create("GameTextAnswere", $old_values);

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
    public function can_add_a_media_image_to_end_of_media_collection_from_game_text_answere()
    {
        $this->create_user('admin');
        // Given
        $old_values = [
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
            "points_min" => 123423,
            "points_max" => 123456
        ];

        $old_game = $this->create("GameTextAnswere", $old_values);

        // attach media
        $this->file_factory($old_game, "media", ["media1", "media2"]);
        
        $files = [
            "media" => [
                UploadedFile::fake()->image("media3.jpg"),
                UploadedFile::fake()->image("media4.jpg"),
            ]
        ];

        // When
        $res = $this->json("PUT","$this->api_base/".$old_game->id, $files);


        // Then
        $res->assertStatus(200)
                    ->assertJsonCount(4, "data.media"); // assert that 2 images have been added to header
                    
        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->media)){
            \Storage::disk("test")->assertExists($stored_header_files_array);
        }
    }

    /**
     * @test
     */
    public function can_update_game_text_answere_fully_on_each_model_attribute()
    {
        $this->create_user('admin');

        // Given
        $old_values = [
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
            "points_min" => 123423,
            "points_max" => 123456
        ];

        $old_game = $this->create("GameTextAnswere", $old_values);

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
                    
        $this->assertDatabaseHas("game_text_answeres", $new_values);
        $this->assertDatabaseMissing("game_text_answeres", $old_values);
            
    }
   
    /**
     * @test
     */
    public function can_update_game_text_answere_on_a_couple_of_model_attributes()
    {
        $this->create_user('admin');
        
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

        $old_game = $this->create("GameTextAnswere", array_merge($old_values_to_be_updated, $old_values_to_remain_after_update));

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
                    
        $this->assertDatabaseHas("game_text_answeres", array_merge($new_values, $old_values_to_remain_after_update));
        $this->assertDatabaseMissing("game_text_answeres", $old_values_to_be_updated);

    }



    /**
     * @test
     */
    public function will_fail_with_error_422_when_body_data_is_of_wrong_type()
    {
        $this->create_user('admin');
        // Given
        $old_values = [
            "title" => "dsfsdvafs",
            "content_text" => "fas af afs asdasd as",
            "correct_answere" => "fsadfafa fas as dfasdfas asdfas dfasfa das",
            "points_min" => 123423,
            "points_max" => 123456
        ];

        $old_game = $this->create("GameTextAnswere", $old_values);

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

        $this->assertDatabaseHas("game_text_answeres", $old_values);          
        $this->assertDatabaseMissing("game_text_answeres", $new_values);

    }
}

trait Delete
{
    /**
     * @test
     */
    public function will_fail_with_a_404_if_the_game_text_answere_we_want_to_delete_is_not_found()
    {
        $this->create_user('admin');
        $res = $this->json("DELETE", "$this->api_base/-1");
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_delete_a_game_text_answere_including_its_files()
    {
        $this->create_user('admin');
        // Given
        // first create a game in the database to delete
        $game = $this->create("GameTextAnswere");

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
        $this->assertDatabaseMissing("game_text_answeres", ["id" => $game->id]);

        \Storage::disk("test")->assertMissing($media);
        \Storage::disk("test")->assertMissing($header);

    }


        /**
     * @test
     */
    public function foreign_poly_relationship_is_set_to_null_after_delete()
    {
        $this->create_user('admin');
        // Given
        // first create a game in the database to delete
        $game = $this->create("GameTextAnswere");

        // holds the polymoprhic relationship type and key
        $challenge = $this->create("Challenge", [
            "game_type" => "text_answere",
            "game_id" =>  $game->id
        ]);
        
        // When
        // call the delete api
        $res = $this->json("DELETE", "/$this->api_base/".$game->id);

        // Then
        $res->assertStatus(204)
            ->assertSee(null);

        // check if $game is deleted from database
        $this->assertDatabaseMissing("game_text_answeres", ["id" => $game->id]);


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
}