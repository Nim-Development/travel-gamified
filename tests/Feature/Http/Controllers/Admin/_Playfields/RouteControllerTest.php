<?php

namespace Tests\Feature\Http\Controllers\Admin\RouteController;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteControllerTest extends TestCase
{

    use RefreshDatabase;
    // Include the different tests (seperated by API type)
    use Get;
    use Post;
    use Put;
    use Delete;


    protected $api_base = "/api/admin/routes";

    /**
     * @test
     */
    public function non_authenticated_user_can_not_access_route_api_endpoints()
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
    public function will_fail_with_a_404_if_route_is_not_found()
    {
$this->create_user('admin');
        $res = $this->json("GET", "$this->api_base/-1");
        $res->assertStatus(404);
    }

        /**
     * @test
     */
    public function will_return_204_when_requesting_all_routes_whilst_no_entries_in_database()
    {
$this->create_user('admin');
        // Skip any creates
        $res = $this->json("GET", "$this->api_base");
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_routes_whilst_no_entries_in_database()
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

        // Create route without relationship
        $route = $this->create("Route");

        // When
        $response = $this->json("GET", "/$this->api_base/".$route->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                     "data" => [
                        "id" => $route->id,
                        "name" => $route->name,
                        "maps_url" => $route->maps_url,
                        "kilometers" => $route->kilometers,
                        "hours" => $route->hours,
                        "difficulty" => $route->difficulty,
                        "nature" => $route->nature,
                        "highway" => $route->highway,
                        "transit" => null,
                        "created_at" => (string)$route->created_at,
                    ]
                ]);

    }



    /**
     * @test
     */
    public function can_return_a_route()
    {
$this->create_user('admin');
        // Given
        $transit = $this->create("Transit", [
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id,
        ]);

        $route = $this->create("Route", ["transit_id" => $transit->id]);

        // When
        $response = $this->json("GET", "/$this->api_base/".$route->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                     "data" => [
                        "id" => $route->id,
                        "name" => $route->name,
                        "maps_url" => $route->maps_url,
                        "kilometers" => $route->kilometers,
                        "hours" => $route->hours,
                        "difficulty" => $route->difficulty,
                        "nature" => $route->nature,
                        "highway" => $route->highway,
                        "transit" => [
                            "id" => $transit->id,
                            "type" => "transit",
                            "name" => $transit->name,
                            "from" => [
                                "id" => $transit->from->id,
                                "type" => "city",
                                "short_code" => $transit->from->short_code,
                                "name" => $transit->from->name,
                                "created_at" => (string)$transit->from->created_at
                            ],
                            "to" => [
                                "id" => $transit->to->id,
                                "type" => "city",
                                "short_code" => $transit->to->short_code,
                                "name" => $transit->to->name,
                                "created_at" => (string)$transit->to->created_at
                            ],
                            "created_at" => (string)$transit->created_at
                        ],
                        "created_at" => (string)$route->created_at,
                        // "updated_at" => (string)$route->updated_at
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_all_routes()
    {
$this->create_user('admin');
        $transit = $this->create("Transit", [
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id,
        ]);

        $this->create_collection("Route", ["transit_id" => $transit->id], false, 6);

        $response = $this->json("GET", "/$this->api_base");

        $response->assertStatus(200)
                ->assertJsonCount(6, "data")
                ->assertJsonStructure([
                    "data" => [
                        "*" => [ //* to say we checking keys of multiple collections
                            "id",
                            "name",
                            "maps_url",
                            "kilometers",
                            "hours",
                            "difficulty",
                            "nature",
                            "highway",
                            "transit" => [
                                "id",
                                "type",
                                "name",
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
                                "created_at"
                            ],
                            "created_at"
                        ]
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_paginated_routes()
    {
$this->create_user('admin');
        $transit = $this->create("Transit", [
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id,
        ]);

        $this->create_collection("Route", ["transit_id" => $transit->id], false, 6);

        $response = $this->json("GET", "/$this->api_base/paginate/3");

        $response->assertStatus(200)
                ->assertJsonCount(3, "data")
                ->assertJsonStructure([
                    "data" => [
                        "*" => [ //* to say we checking keys of multiple collections
                            "id",
                            "name",
                            "maps_url",
                            "kilometers",
                            "hours",
                            "difficulty",
                            "nature",
                            "highway",
                            "transit" => [
                                "id",
                                "type",
                                "name",
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
                                "created_at"
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
    public function can_create_a_route_with_a_valid_transit_relationship()
    {
        $this->create_user('admin');
        $transit = $this->create("Transit", [
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id,
        ]);

        $body = [
            "transit_id" => $transit->id,
            "name" => "asadsff",
            "maps_url" => "https://asadssadadsff.sad/sadmkas/asdasd",
            "kilometers" => 21.23,
            "hours" => 4.45,
            "difficulty" => 8,
            "nature" => 4,
            "highway" => 6,
        ];

        $res = $this->json("POST", "/$this->api_base", $body);

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                "data" => [
                    "id",
                    "name",
                    "maps_url",
                    "kilometers",
                    "hours",
                    "difficulty",
                    "nature",
                    "highway",
                    "transit" => [
                        "id",
                        "type",
                        "name",
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
                        "created_at"
                    ],
                    "created_at"
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas("routes", $body);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_because_relational_transit_is_not_given()
    {
        $this->create_user('admin');
        $body = [
            "name" => "asadsff",
            "maps_url" => "https://asadssadadsff.sad/sadmkas/asdasd",
            "kilometers" => 21.23,
            "hours" => 4.45,
            "difficulty" => 8,
            "nature" => 4,
            "highway" => 6,
        ];

        $res = $this->json("POST", "/$this->api_base", $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing("routes", $body);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_because_the_relational_transit_in_request_body_does_not_exist_in_database()
    {
$this->create_user('admin');
        $body = [
            "transit_id" => -1,
            "name" => "asadsff",
            "maps_url" => "https://asadssadadsff.sad/sadmkas/asdasd",
            "kilometers" => 21.23,
            "hours" => 4.45,
            "difficulty" => 8,
            "nature" => 4,
            "highway" => 6,
        ];

        $res = $this->json("POST", "/$this->api_base", $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing("routes", $body);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_body_failed_validation_because_of_wrong_data_types()
    {
$this->create_user('admin');
        $transit = $this->create("Transit", [
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id,
        ]);

        // "name" value is of wrong data type
        $body = [
            "transit_id" => $transit->id,
            "name" => 3283,
            "maps_url" => "https://asadssadadsff.sad/sadmkas/asdasd",
            "kilometers" => 21.23,
            "hours" => 4.45,
            "difficulty" => 8,
            "nature" => 4,
            "highway" => 6,
        ];

        $res = $this->json("POST", "/$this->api_base", $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing("routes", $body);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_body_failed_validation_because_data_was_missing()
    {
$this->create_user('admin');
        $transit = $this->create("Transit", [
            "from_city_id" => $this->create("City")->id,
            "to_city_id" => $this->create("City")->id,
        ]);

        // "name" is missing
        $body = [
            "transit_id" => $transit->id,
            "maps_url" => "https://asadssadadsff.sad/sadmkas/asdasd",
            "kilometers" => 21.23,
            "hours" => 4.45,
            "difficulty" => 8,
            "nature" => 4,
            "highway" => 6,
        ];

        $res = $this->json("POST", "/$this->api_base", $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing("routes", $body);
    }


}

trait Put
{


        /**
     * @test
     */
    public function will_fail_with_a_404_if_the_routes_we_want_to_update_is_not_found()
    {
$this->create_user('admin');
        $res = $this->json("PUT", "$this->api_base/-1");
        $res->assertStatus(404);
    }



    /**
     * @test
     */
    public function can_update_route_fully_on_each_model_attribute()
    {
        
        $this->create_user('admin');

        $old_values = [
            "transit_id" => $this->create("Transit", [
                "from_city_id" => $this->create("City")->id,
                "to_city_id" => $this->create("City")->id,
            ])->id,
            "name" => "asadsff",
            "maps_url" => "https://asadssadadsff.sad/sadmkas/asdasd",
            "kilometers" => 21.23,
            "hours" => 4.45,
            "difficulty" => 8,
            "nature" => 4,
            "highway" => 6,
        ];

        $old_route = $this->create("Route", $old_values);


        // update every attribute
        $new_values = [
            "name" => "aaaaaaaaa",
            "maps_url" => "https://aaaaaaaa.aa/aaaaaaa/aaaaa",
            "kilometers" => 00.1,
            "hours" => 0.01,
            "difficulty" => 01,
            "nature" => 01,
            "highway" => 01,
        ];

        $transit_id = [
            "transit_id" => $this->create("Transit", [
                "from_city_id" => $this->create("City")->id,
                "to_city_id" => $this->create("City")->id,
            ])->id,
        ];

        // When
        $response = $this->json("PUT","$this->api_base/".$old_route->id, array_merge($transit_id, $new_values));

        // Then
        $response->assertStatus(200)
                    ->assertJsonFragment($new_values);
                    
        $this->assertDatabaseHas("routes", $new_values);
        $this->assertDatabaseMissing("routes", $old_values);
            
    }
   
    /**
     * @test
     */
    public function can_update_city_on_a_couple_of_model_attributes()
    {
$this->create_user('admin');
        $old_values = [
            "transit_id" => $this->create("Transit", [
                "from_city_id" => $this->create("City")->id,
                "to_city_id" => $this->create("City")->id,
            ])->id,
            "name" => "asadsff",
            "maps_url" => "https://asadssadadsff.sad/sadmkas/asdasd",
        ];

        $old_values_to_remain_after_update = [
            "kilometers" => 21.23,
            "hours" => 4.45,
            "difficulty" => 8,
            "nature" => 4,
            "highway" => 6
        ];

        $old_route = $this->create("Route", array_merge($old_values, $old_values_to_remain_after_update));


        // update every attribute
        $new_values = [
            "name" => "aaaaaaaaa",
            "maps_url" => "https://aaaaaaaa.aa/aaaaaaa/aaaaa"
        ];

        $transit_id = [
            "transit_id" => $this->create("Transit", [
                "from_city_id" => $this->create("City")->id,
                "to_city_id" => $this->create("City")->id,
            ])->id,
        ];

        // When
        $response = $this->json("PUT","$this->api_base/".$old_route->id, array_merge($new_values, $transit_id));

        // Then
        $response->assertStatus(200)
                    ->assertJsonFragment(array_merge($new_values, $old_values_to_remain_after_update));
                    
        $this->assertDatabaseHas("routes", array_merge($new_values, $old_values_to_remain_after_update));
        $this->assertDatabaseMissing("routes", $old_values);
    }

    /**
     * @test
     */
    public function will_fail_with_error_422_when_body_data_is_of_wrong_type()
    {
$this->create_user('admin');
        $old_values = [
            "transit_id" => $this->create("Transit", [
                "from_city_id" => $this->create("City")->id,
                "to_city_id" => $this->create("City")->id,
            ])->id,
            "name" => "asadsff",
            "maps_url" => "https://asadssadadsff.sad/sadmkas/asdasd",
            "kilometers" => 21.23,
            "hours" => 4.45,
            "difficulty" => 8,
            "nature" => 4,
            "highway" => 6
        ];

        $old_route = $this->create("Route", $old_values);

        // "name" is of wrong type
        $new_values = [
            "transit_id" => $this->create("Transit", [
                "from_city_id" => $this->create("City")->id,
                "to_city_id" => $this->create("City")->id,
            ])->id,
            "name" => 000001,
            "maps_url" => "https://aaaaaaaa.aa/aaaaaaa/aaaaa",
            "kilometers" => 00.001,
            "hours" => 0.01,
            "difficulty" => 01,
            "nature" => 01,
            "highway" => 01,
        ];

        // When
        $response = $this->json("PUT","$this->api_base/".$old_route->id, $new_values);

        // Then
        $response->assertStatus(422);
                    
        $this->assertDatabaseHas("routes", $old_values);
        $this->assertDatabaseMissing("routes", $new_values);

    }

        /**
     * @test
     */
    public function will_fail_with_error_422_relational_transit_does_not_exist()
    {
$this->create_user('admin');
        $old_values = [
            "transit_id" => $this->create("Transit", [
                "from_city_id" => $this->create("City")->id,
                "to_city_id" => $this->create("City")->id,
            ])->id,
            "name" => "asadsff",
            "maps_url" => "https://asadssadadsff.sad/sadmkas/asdasd",
            "kilometers" => 21.23,
            "hours" => 4.45,
            "difficulty" => 8,
            "nature" => 4,
            "highway" => 6,
        ];

        $old_route = $this->create("Route", $old_values);

        // "transit_id" is of -1 whish clearly doesn"t exist
        $new_values = [
            "transit_id" => -1,
            "name" => "aaaaa",
            "maps_url" => "https://aaaaaaaa.aa/aaaaaaa/aaaaa",
            "kilometers" => 00.001,
            "hours" => 0.01,
            "difficulty" => 01,
            "nature" => 01,
            "highway" => 01,
        ];

        // When
        $response = $this->json("PUT","$this->api_base/".$old_route->id, $new_values);

        // Then
        $response->assertStatus(422);
                    
        $this->assertDatabaseHas("routes", $old_values);
        $this->assertDatabaseMissing("routes", $new_values);

    }
}

trait Delete
{
    /**
     * @test
     */
    public function will_fail_with_a_404_if_the_route_we_want_to_delete_is_not_found()
    {
$this->create_user('admin');
        $res = $this->json("DELETE", "$this->api_base/-1");
        $res->assertStatus(404);
    }


    /**
     * @test
     */
    public function foreign_route_poly_relationships_are_set_to_null_after_delete()
    {
$this->create_user('admin');

        /**
         * playfields:
         * - challenges
         * - itineraries
         */

        // Given
        // first create a game in the database to delete
        $route = $this->create("Route");

        // holds the polymoprhic relationship type and key
        $challenge = $this->create("Challenge", [
            "playfield_type" => "route",
            "playfield_id" =>  $route->id
        ]);
        $itineraries = $this->create_collection("Itinerary", [
            "playfield_type" => "route",
            "playfield_id" =>  $route->id
        ], false, 3);
        
        // When
        // call the delete api
        $res = $this->json("DELETE", "/$this->api_base/".$route->id);

        // Then
        $res->assertStatus(204)
            ->assertSee(null);

        // check if $game is deleted from database
        $this->assertDatabaseMissing("routes", ["id" => $route->id]);

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
}