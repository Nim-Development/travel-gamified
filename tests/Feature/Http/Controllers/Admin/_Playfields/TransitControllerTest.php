<?php

namespace Tests\Feature\Http\Controllers\Admin\TransitController;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransitControllerTest extends TestCase
{

    use RefreshDatabase;
    // Include the different tests (seperated by API type)
    use Get;
    use Post;
    use Put;
    use Delete;

    protected $api_base = "/api/admin/transits";
    /**
     * @test
     */
    public function non_authenticated_user_can_not_access_transit_api_endpoints()
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
    public function will_fail_with_a_404_if_transit_is_not_found()
    {
        $this->create_user('admin');
        $res = $this->json("GET", "$this->api_base/-1");
        $res->assertStatus(404);
    }

        /**
     * @test
     */
    public function will_return_204_when_requesting_all_transits_whilst_no_entries_in_database()
    {
        $this->create_user('admin');
        // Skip any creates
        $res = $this->json("GET", "$this->api_base");
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_transits_whilst_no_entries_in_database()
    {
        $this->create_user('admin');
        // Skip any creates
        $res = $this->json("GET", "$this->api_base/paginate/3");
        $res->assertStatus(204);
    }


    /**
     * @test
     */
    public function returns_a_null_value_on_relationships_if_there_are_no_relationships_available()
    {
        $this->create_user('admin');
        // EXCEPT FOR CITY RELATIONSHIP (FROM & TO), THESE ARE ALWAYS REQUIRED

        $from = $this->create("City");
        $to = $this->create("City");

        // Given
        // Create transit without any relationships
        $transit = $this->create("Transit", [
            "from_city_id" => $from->id,
            "to_city_id" => $to->id
        ]);
    
        // When
        $response = $this->json("GET", "/$this->api_base/".$transit->id);

        \TimeConverter::secondsToDhm($transit->duration);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                    "data" => [
                        "id" => $transit->id,
                        "name" => $transit->name,
                        "duration" => [
                            'days' => (integer) \TimeConverter::getDays(),
                            'hours' => (integer) \TimeConverter::getHours(),
                            'minutes' => (integer) \TimeConverter::getMinutes()
                        ],
                        "from" => [
                            "id" => $from->id,
                            "type" => "city",
                            "short_code" => $from->short_code,
                            "name" => $from->name,
                            "created_at" => (string)$from->created_at
                        ], // City relationship
                        "to" => [
                            "id" => $to->id,
                            "type" => "city",
                            "short_code" => $to->short_code,
                            "name" => $to->name,
                            "created_at" => (string)$to->created_at
                        ], // City relationship
                        "routes" => null,
                        "challenges" => null,
                        "created_at" => (string)$transit->created_at,
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_transit()
    {
        $this->create_user('admin');

        $from = $this->create("City");
        $to = $this->create("City");

        // Given
        // inserting a model into the database (we know this will work because test can_create_a_transit() was asserted succesfully)
        $transit = $this->create("Transit", [
            "from_city_id" => $from->id,
            "to_city_id" => $to->id
        ]);

        /** Link 2 Routes to transit */
        $route_1 = $this->create("Route", ["transit_id" => $transit->id]);
        $route_2 = $this->create("Route", ["transit_id" => $transit->id]);

        // insert game into challenge & insert playfield into challenge.
        $game_1  = $this->create("GameTextAnswere");
        $challenge_1 = $this->create("Challenge", [
                "game_type" => "text_answere", 
                "game_id" => $game_1->id,
                "playfield_type" => "transit",
                "playfield_id" => $transit->id
            ]);
        
        // insert game into challenge
        $game_2 = $this->create("GameTextAnswere");
        $challenge_2 = $this->create("Challenge", [
            "game_type" => "text_answere", 
            "game_id" => $game_2->id,
            "playfield_type" => "transit",
            "playfield_id" => $transit->id
        ]);

        // link itinerary to Transit
        $itinerary  = $this->create("Itinerary", [
            "playfield_type" => "transit",
            "playfield_id" => $transit->id
        ]);
            
        // When
        $response = $this->json("GET", "/$this->api_base/".$transit->id);


        \TimeConverter::secondsToDhm($transit->duration); 
        $transit_days = \TimeConverter::getDays();
        $transit_hours = \TimeConverter::getHours();
        $transit_minutes = \TimeConverter::getMinutes();

        \TimeConverter::secondsToDhm($route_1->duration); 
        $route_1_days = \TimeConverter::getDays();
        $route_1_hours = \TimeConverter::getHours();
        $route_1_minutes = \TimeConverter::getMinutes();

        \TimeConverter::secondsToDhm($route_2->duration); 
        $route_2_days = \TimeConverter::getDays();
        $route_2_hours = \TimeConverter::getHours();
        $route_2_minutes = \TimeConverter::getMinutes();

        // Then
        // assert status code
        $response->assertStatus(200)
                
                // !!! PROBLEM: routes->highway komen niet overeen... de rest van de properties well.. vage shit.
                 ->assertExactJson([
                    "data" => [
                        "id" => $transit->id,
                        "name" => $transit->name,
                        "duration" => [
                            "days" => $transit_days,
                            "hours" => $transit_hours,
                            "minutes" => $transit_minutes,
                        ],
                        "from" => [
                            "id" => $from->id,
                            "type" => "city",
                            "short_code" => $from->short_code,
                            "name" => $from->name,
                            "created_at" => (string)$from->created_at
                        ], // City relationship
                        "to" => [
                            "id" => $to->id,
                            "type" => "city",
                            "short_code" => $to->short_code,
                            "name" => $to->name,
                            "created_at" => (string)$to->created_at
                        ], // City relationship
                        "routes" => [
                            [
                                "id" => (integer)$route_1->id,
                                "name" => $route_1->name,
                                "duration" => [
                                    "days" => (integer)$route_1_days,
                                    "hours" => (integer)$route_1_hours,
                                    "minutes" => (integer)$route_1_minutes,
                                ],
                                "maps_url" => $route_1->maps_url,
                                "polyline" => $route_1->polyline,
                                "kilometers" => (double)$route_1->kilometers,
                                "difficulty" => (integer)$route_1->difficulty,
                                "nature" => (integer)$route_1->nature,
                                "highway" => (integer)$route_1->highway,
                                "created_at" => (string)$route_1->created_at
                            ],
                            [
                                "id" => (integer)$route_2->id,
                                "name" => $route_2->name,
                                "duration" => [
                                    "days" => (integer)$route_2_days,
                                    "hours" => (integer)$route_2_hours,
                                    "minutes" => (integer)$route_2_minutes,
                                ],
                                "maps_url" => $route_2->maps_url,
                                "polyline" => $route_2->polyline,
                                "kilometers" => (double)$route_2->kilometers,
                                "difficulty" => (integer)$route_2->difficulty,
                                "nature" => (integer)$route_2->nature,
                                "highway" => (integer)$route_2->highway,
                                "created_at" => (string)$route_2->created_at
                            ]
                        ],
                        "challenges" => [
                            [
                                "id" => $challenge_1->id,
                                "sort_order" => $challenge_1->sort_order,
                                "game" => [
                                    "id" => (integer)$challenge_1->game->id,
                                    "type" => $challenge_1->game->type,
                                    "title" => $challenge_1->game->title,
                                    "content_text" => $challenge_1->game->content_text,
                                    "correct_answere" => $challenge_1->game->correct_answere,
                                    "points_min" => (integer)$challenge_1->game->points_min,
                                    "points_max" => (integer)$challenge_1->game->points_max,
                                    "created_at" => (string)$challenge_1->game->created_at
                                ],
                                "created_at" => (string)$challenge_1->created_at
                            ],
                            [
                                "id"  => $challenge_2->id,
                                "sort_order"  => $challenge_2->sort_order,
                                "game" => [
                                    "id" => (integer)$challenge_2->game->id,
                                    "type" => $challenge_2->game->type,
                                    "title" => $challenge_2->game->title,
                                    "content_text" => $challenge_2->game->content_text,
                                    "correct_answere" => $challenge_2->game->correct_answere,
                                    "points_min" => (integer)$challenge_2->game->points_min,
                                    "points_max" => (integer)$challenge_2->game->points_max,
                                    "created_at" => (string)$challenge_2->game->created_at
                                ],
                                "created_at" => (string)$challenge_2->created_at
                            ]
                        ],
                        "created_at" => (string)$transit->created_at,
                    ]
                ]);
    }


    /**
     * @test
     */
    public function can_return_a_collection_of_all_transits()
    {
        $this->create_user('admin');   
        $from = $this->create("City");
        $to = $this->create("City");

        $transits = $this->create_collection("Transit", [
            "from_city_id" => $from->id,
            "to_city_id" => $to->id
        ], false, 3);

        // generates a collection of transits and creates / links all relational data.
        $this->insert_relations_into_transit_collection($transits, "text_answere");

        $response = $this->json("GET", "/$this->api_base");
        $response->assertStatus(200)
                ->assertJsonCount(3, "data")
                ->assertJsonStructure([
                    "data" => [
                        "*" => [
                            "id",
                            "name",
                            "duration",
                            "from" => [
                                "id",
                                "type",
                                "short_code",
                                "name",
                                "created_at"
                            ],
                            "to" => [
                                "id",
                                "type",
                                "short_code",
                                "name",
                                "created_at"
                            ],
                            "routes" => [
                                "*" =>
                                    [
                                        "id",
                                        "name",
                                        "duration",
                                        "maps_url",
                                        "polyline",
                                        "kilometers",
                                        "difficulty",
                                        "nature",
                                        "highway",
                                        "created_at"
                                    ]
                            ],
                            "challenges" => [
                                "*" =>
                                    [
                                        "id",
                                        "sort_order",
                                        "game" => [
                                            "id",
                                            "type",
                                            "title",
                                            "content_text",
                                            "correct_answere",
                                            "points_min",
                                            "points_max",
                                            "created_at"
                                        ],
                                        "created_at"
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
    public function can_return_a_collection_of_paginated_transits()
    {
        $this->create_user('admin');
        $from = $this->create("City");
        $to = $this->create("City");

        $transits = $this->create_collection("Transit", [
            "from_city_id" => $from->id,
            "to_city_id" => $to->id
        ], false, 6);

        // generates a collection of transits and creates / links all relational data.
        $this->insert_relations_into_transit_collection($transits, "text_answere");

        $response = $this->json("GET", "/$this->api_base/paginate/3");
        $response->assertStatus(200)
                ->assertJsonCount(3, "data")
                ->assertJsonStructure([
                    "data" => [
                        "*" => [
                            "id",
                            "name",
                            "duration",
                            "from" => [
                                "id",
                                "type",
                                "short_code",
                                "name",
                                "created_at"
                            ],
                            "to" => [
                                "id",
                                "type",
                                "short_code",
                                "name",
                                "created_at"
                            ],
                            "routes" => [
                                "*" =>
                                    [
                                        "id",
                                        "name",
                                        "duration",
                                        "maps_url",
                                        "polyline",
                                        "kilometers",
                                        "difficulty",
                                        "nature",
                                        "highway",
                                        "created_at"
                                    ]
                            ],
                            "challenges" => [
                                "*" =>
                                    [
                                        "id",
                                        "sort_order",
                                        "game" => [
                                            "id",
                                            "type",
                                            "title",
                                            "content_text",
                                            "correct_answere",
                                            "points_min",
                                            "points_max",
                                            "created_at"
                                        ],
                                        "created_at"
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
}

trait Post
{
    /**
     * @test
     */
    public function can_create_a_transit_with_routes()
    {
        $this->create_user('admin');
        $body = [
            "name" => "sdad hx as hh dsuah ihas",
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id
        ];
        $routes = [
            "routes" => [
                $this->create("Route")->id,
                $this->create("Route")->id,
                $this->create("Route")->id,
            ] // route ids
        ];

        $res = $this->json("POST", "/$this->api_base", array_merge($body, $routes));

        // the 3 relationships will always be null at first create, because the relational models hold all the foreign keys.
        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                "data" => [
                    "id",
                    "name",
                    "duration",
                    "from" => [
                        "id",
                        "type",
                        "short_code",
                        "name",
                        "created_at"
                    ],
                    "to" => [
                        "id",
                        "type",
                        "short_code",
                        "name",
                        "created_at"
                    ],
                    "routes" => [
                        "*" => [
                            "id",
                            "name",
                            "maps_url",
                            "polyline",
                            "kilometers",
                            "duration",
                            "difficulty",
                            "nature",
                            "highway",
                            "created_at"
                        ]
                    ],
                    "challenges", //null
                    "created_at"
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas("transits", $body);
    }


        /**
     * @test
     */
    public function can_create_a_transit_without_routes()
    {
        $this->create_user('admin');
        $body = [
            "name" => "sdad hx as hh dsuah ihas",
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id
        ];

        $res = $this->json("POST", "/$this->api_base", $body);

        // the 3 relationships will always be null at first create, because the relational models hold all the foreign keys.
        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                "data" => [
                    "id",
                    "name",
                    "duration",
                    "from" => [
                        "id",
                        "type",
                        "short_code",
                        "name",
                        "created_at"
                    ],
                    "to" => [
                        "id",
                        "type",
                        "short_code",
                        "name",
                        "created_at"
                    ],
                    "routes",
                    "challenges", //null
                    "created_at"
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas("transits", $body);
    }

        /**
     * @test
     */
    public function will_fail_with_a_422_if_relational_from_city_does_not_exist_in_database()
    {
        $this->create_user('admin');
        // "name" is wrong data type
        $body = [
            "name" => "sadasasd",
            "from_city_id" => -1,
            "to_city_id" => $this->create("City")->id
        ];

        $res = $this->json("POST", "/$this->api_base", $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing("transits", $body);
    }

            /**
     * @test
     */
    public function will_fail_with_a_422_if_relational_to_city_does_not_exist_in_database()
    {
        $this->create_user('admin');
        // "name" is wrong data type
        $body = [
            "name" => "addasads",
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => -1
        ];

        $res = $this->json("POST", "/$this->api_base", $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing("transits", $body);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_body_failed_validation_because_of_wrong_data_types_in_body()
    {
        $this->create_user('admin');
        // "name" is wrong data type
        $body = [
            "name" => 234,
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id
        ];

        $res = $this->json("POST", "/$this->api_base", $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing("transits", $body);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_body_failed_validation_because_data_was_missing_from_body()
    {
        $this->create_user('admin');
        // "name" is missing
        $body = [
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id
        ];

        $res = $this->json("POST", "/$this->api_base", $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing("transits", $body);
    }

}

trait Put
{
    
    /**
     * @test
     */
    public function will_fail_with_a_404_if_the_transit_we_want_to_update_is_not_found()
    {
        $this->create_user('admin');
        $res = $this->json("PUT", "$this->api_base/-1");
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_update_transit_fully_on_each_model_attribute()
    {
        $this->create_user('admin');
        $old_values = [
            "name" => "sdad hx as hh dsuah ihas",
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id
        ];
        $old_transit = $this->create("Transit", $old_values);
        // attach 2 routes to transit
        $this->create("Route", ["transit_id" => $old_transit->id]);
        $this->create("Route", ["transit_id" => $old_transit->id]);

        $new_values = [
            "name" => "aaaaaaaaaaaaaaaaaaa"
        ];
        $cities = [
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id
        ];

        // When
        $res = $this->json("PUT","$this->api_base/".$old_transit->id, array_merge($new_values, $cities));

        // Then
        $res->assertStatus(200)
            ->assertJsonFragment($new_values);

        $this->assertDatabaseHas("transits",$new_values);
        $this->assertDatabaseMissing("transits",$old_values);
        
    }
    
    /**
     * @test
     */
    public function can_update_game_text_answere_on_a_couple_of_model_attributes()
    {
        $this->create_user('admin');
        
        $old_values = [
            "name" => "sdad hx as hh dsuah ihas",
        ];

        $old_values_to_remain_after_update = [
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id
        ];

        $old_transit = $this->create("Transit", array_merge($old_values, $old_values_to_remain_after_update));

        $new_values = [
            "name" => "aaaaaaaaaaaaaaaaaaa"
        ];

        // When
        $res = $this->json("PUT","$this->api_base/".$old_transit->id, $new_values);

        // Then
        $res->assertStatus(200)
            ->assertJsonFragment(array_merge($new_values)); 

        $this->assertDatabaseHas("transits",array_merge($new_values, $old_values_to_remain_after_update));
        $this->assertDatabaseMissing("transits",$old_values);

    }
    
    /**
     * @test
     */
    public function can_add_new_routes_to_transit()
    {
        $this->create_user('admin');
        // Given
        $old_values = [
            "name" => "sdad hx as hh dsuah ihas",
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id
        ];

        $old_transit = $this->create("Transit", $old_values);

        $this->create("Route", ["transit_id" => $old_transit->id]);
        $this->create("Route", ["transit_id" => $old_transit->id]);

        // update every attribute
        $new_values = [
            "name" => "sdad hx as hh dsuah ihas",
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id
        ];

        $routes = [
            "routes" => [
                $this->create("Route")->id,
                $this->create("Route")->id
            ] // route ids
        ];

        // When
        $response = $this->json("PUT","$this->api_base/".$old_transit->id, array_merge($new_values, $routes));


        // Then
        $response->assertStatus(200)
                    ->assertJsonCount(4, "data.routes");
                
            
    }



    /**
     * @test
     */
    public function will_fail_with_error_422_if_relational_city_does_not_exist()
    {
        $this->create_user('admin');
        $old_values = [
            "name" => "sdad hx as hh dsuah ihas",
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id
        ];
        $old_transit = $this->create("Transit", $old_values);
        // attach 2 routes to transit
        $this->create("Route", ["transit_id" => $old_transit->id]);
        $this->create("Route", ["transit_id" => $old_transit->id]);

        // "from_city_id" does not exist
        $new_values = [
            "name" => "aaaaaaaaaaaaaaaaaaa",
            "from_city_id" => -1,
            "to_city_id" => $this->create("City")->id
        ];

        // When
        $res = $this->json("PUT","$this->api_base/".$old_transit->id, $new_values);

        // Then
        $res->assertStatus(422);

        $this->assertDatabaseHas("transits",$old_values);
        $this->assertDatabaseMissing("transits",$new_values);
    }
   
    /**
     * @test
     */
    public function will_fail_with_error_422_if_relational_route_does_not_exist()
    {
        $this->create_user('admin');
        $old_values = [
            "name" => "sdad hx as hh dsuah ihas",
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id
        ];
        $old_transit = $this->create("Transit", $old_values);
        // attach 2 routes to transit
        $this->create("Route", ["transit_id" => $old_transit->id]);
        $this->create("Route", ["transit_id" => $old_transit->id]);

        // "from_city_id" does not exist
        $new_values = [
            "name" => "aaaaaaaaaaaaaaaaaaa",
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id
        ];
        $routes = [
            "routes" => [
                -1,
                $this->create("Route")->id
            ]
        ];

        // When
        $res = $this->json("PUT","$this->api_base/".$old_transit->id, array_merge($new_values, $routes));

        // Then
        $res->assertStatus(422);

        $this->assertDatabaseHas("transits",$old_values);
        $this->assertDatabaseMissing("transits",$new_values);
    }

    /**
     * @test
     */
    public function will_fail_with_error_422_when_body_data_is_of_wrong_type()
    {
        $this->create_user('admin');
        // Given
        $old_values = [
            "name" => "sdad hx as hh dsuah ihas",
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id
        ];

        $old_transit = $this->create("Transit", $old_values);

        // "name" is of wrong type
        $new_values = [
            "name" => 00001,
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id
        ];

        // When
        $response = $this->json("PUT","$this->api_base/".$old_transit->id, $new_values);

        // Then
        $response->assertStatus(422);

        $this->assertDatabaseHas("transits", $old_values);          
        $this->assertDatabaseMissing("transits", $new_values);

    }


}

trait Delete
{
    /**
     * @test
     */
    public function will_fail_with_a_404_if_the_transit_we_want_to_delete_is_not_found()
    {
        $this->create_user('admin');
        $res = $this->json("DELETE", "$this->api_base/-1");
        $res->assertStatus(404);
    }


    /**
     * @test
     */
    public function foreign_transit_poly_relationships_are_set_to_null_after_delete()
    {
        $this->create_user('admin');

        /**
         * playfields:
         * - challenges
         * - itineraries
         */

        // Given
        // first create a game in the database to delete
        $transit = $this->create("Transit");

        // holds the polymoprhic relationship type and key
        $challenge = $this->create("Challenge", [
            "playfield_type" => "transit",
            "playfield_id" =>  $transit->id
        ]);
        $itineraries = $this->create_collection("Itinerary", [
            "playfield_type" => "transit",
            "playfield_id" =>  $transit->id
        ], false, 3);
        
        // When
        // call the delete api
        $res = $this->json("DELETE", "/$this->api_base/".$transit->id);

        // Then
        $res->assertStatus(204)
            ->assertSee(null);

        // check if $game is deleted from database
        $this->assertDatabaseMissing("transits", ["id" => $transit->id]);


        // refresh the poly relation from database
        $challenge->refresh();
        // check if polymorphic keys have been set to null
        if(!$challenge->playfield_type && !$challenge->playfield_id){
            // game_type and game_id have been set to NULL !
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }

                
        // ::nk FAILS because $route->itenireary should be morphMany()!..
        // or this test should always bge for songular relation.

        // check if polymorphic keys have been set to null
        foreach($itineraries as $itinerary){
            $itinerary->refresh();
            if(!$itinerary->playfield_type && !$itinerary->playfield_id){
                $this->assertTrue(true);
            }else{
                $this->assertTrue(false);
            }
        }
    }


        /**
     * @test
     */
    public function foreign_transit_keys_in_relational_routes_are_set_to_null_after_city_delete()
    {
        $this->create_user('admin');

        /**
         * relation city_ids
         * - routes->transit_id
         */

        // Given
        // first create a game in the database to delete
        $transit = $this->create("Transit");

        // holds the polymoprhic relationship type and key
        $routes = $this->create_collection("Route", [
            "transit_id" =>  $transit->id
        ], false, 3);
        
        // When
        // call the delete api
        $res = $this->json("DELETE", "/$this->api_base/".$transit->id);

        // Then
        $res->assertStatus(204)
            ->assertSee(null);

        // check if $game is deleted from database
        $this->assertDatabaseMissing("transits", ["id" => $transit->id]);

        // assert if game_id of all previously relational options have been set to null.
        foreach($routes as $route){
            $route->refresh();
            if(!$route->transit_id){
                $this->assertTrue(true);
            }else{
                $this->assertTrue(false);
            }
        }
    }


}