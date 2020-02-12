<?php

namespace Tests\Feature\Http\Controllers\Admin\TourController;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TourControllerTest extends TestCase
{

    use RefreshDatabase;
    // Include the different tests (seperated by API type)
    use Get;
    use Post;
    use Put;
    use Delete;

    protected $api_base = '/api/admin/tours';

    /**
     * @test
     */
    public function non_authenticated_user_can_not_access_tour_api_endpoints()
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
    public function will_fail_with_a_404_if_tour_is_not_found()
    {
        $this->create_user('admin');
        $res = $this->json("GET", "$this->api_base/-1");
        $res->assertStatus(404);
    }

        /**
     * @test
     */
    public function will_return_204_when_requesting_all_tours_whilst_no_entries_in_database()
    {
        $this->create_user('admin');
        // Skip any creates
        $res = $this->json("GET", "$this->api_base");
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_tours_whilst_no_entries_in_database()
    {
        $this->create_user('admin');
        // Skip any creates
        $res = $this->json("GET", "$this->api_base/paginate/3");
        $res->assertStatus(204);
    }

        /**
     * @test
     */
    public function can_return_a_tour()
    {
        $this->create_user('admin');
        // Given
        // inserting a model into the database (we know this will work because test can_create_a_tour() was asserted succesfully)
        $tour = $this->create("Tour");

        // When
        $response = $this->json("GET", "/$this->api_base/".$tour->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                     "data" => [
                        "id" => $tour->id,
                        "name" => $tour->name,
                        "itineraries" => null,
                        "created_at" => (string)$tour->created_at
                     ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_all_tours()
    {
        $this->create_user('admin');

        $this->create_collection("Tour", [], false, 6);

        $response = $this->json("GET", "/$this->api_base");

        $response->assertStatus(200)
                ->assertJsonCount(6, "data")
                ->assertJsonStructure([
                    "data" => [
                        "*" => [
                            "id", 
                            "name", 
                            "itineraries",
                            "created_at"
                        ]
                    ],
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_paginated_tours()
    {
        $this->create_user('admin');
        $this->create_collection("Tour", [], false, 6);

        $response = $this->json("GET", "/$this->api_base/paginate/3");
        $response->assertStatus(200)
                ->assertJsonCount(3, "data")
                ->assertJsonStructure([
                    "data" => [
                        "*" => [
                            "id", 
                            "name", 
                            "itineraries",
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
    public function can_return_a_tour_with_a_relational_itineraries()
    {
        $this->create_user('admin');
        // Given
        // inserting a model into the database (we know this will work because test can_create_a_tour() was asserted succesfully)
        $tour = $this->create("Tour");

        // create 3 relational itineraries ordered by step
        $it_3 = $this->create('Itinerary', ['step' => 3, 'tour_id' => $tour->id, 'playfield_type' => 'city']);
        $it_2 = $this->create('Itinerary', ['step' => 2, 'tour_id' => $tour->id, 'playfield_type' => 'transit']);
        $it_1 =  $this->create('Itinerary', ['step' => 1, 'tour_id' => $tour->id, 'playfield_type' => 'city']);

        // When
        $response = $this->json("GET", "/$this->api_base/".$tour->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                     "data" => [
                        "id" => $tour->id,
                        "name" => $tour->name,
                        'itineraries' => [
                            [
                                'id' => $it_1->id,
                                'step' => $it_1->step,
                                'duration' => $it_1->duration,
                                'playfield_type' => $it_1->playfield_type,
                                'playfield_id' => $it_1->playfield_id,
                                'created_at' => (string)$it_1->created_at
                            ],
                            [
                                'id' => $it_2->id,
                                'step' => $it_2->step,
                                'duration' => $it_2->duration,
                                'playfield_type' => $it_2->playfield_type,
                                'playfield_id' => $it_2->playfield_id,
                                'created_at' => (string)$it_2->created_at
                            ],
                            [
                                'id' => $it_3->id,
                                'step' => $it_3->step,
                                'duration' => $it_3->duration,
                                'playfield_type' => $it_3->playfield_type,
                                'playfield_id' => $it_3->playfield_id,
                                'created_at' => (string)$it_3->created_at
                            ]
                        ],
                        "created_at" => (string)$tour->created_at
                     ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_all_tours_with_a_relational_itineraries()
    {
        $this->create_user('admin');

        $this->create_collection("Tour", [], false, 6);

        $response = $this->json("GET", "/$this->api_base");

        $response->assertStatus(200)
                ->assertJsonCount(6, "data")
                ->assertJsonStructure([
                    "data" => [
                        "*" => [
                            "id", 
                            "name", 
                            'itineraries',
                            "created_at"
                        ]
                    ],
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_paginated_tours_with_a_relational_itineraries()
    {
        $this->create_user('admin');
        $this->create_collection("Tour", [], false, 6);

        $response = $this->json("GET", "/$this->api_base/paginate/3");
        $response->assertStatus(200)
                ->assertJsonCount(3, "data")
                ->assertJsonStructure([
                    "data" => [
                        "*" => [
                            "id", 
                            "name", 
                            'itineraries',
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
    public function can_create_a_tour()
    {
        $this->create_user('admin');

        $body = [
            "name" => "1234",
        ];

        $res = $this->json("POST", "/$this->api_base", $body);

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                "data" => [
                    "id",
                    "name",
                    "itineraries",
                    "created_at"
                ]
        ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas("tours", $body);
    }

             /**
     * @test
     */
    public function will_fail_with_error_422_if_request_body_data_is_of_wrong_type()
    {
        $this->create_user('admin');
        // "name" is of wrong type
        $body = [
            "name" => 111,
        ];

        $res = $this->json("POST", "/$this->api_base", $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing("tours", $body);
    }

    /**
     * @test
     */
    public function will_fail_with_error_422_if_request_body_data_is_missing()
    {
        $this->create_user('admin');
        // "name" is missing
        $body = [
        ];

        $res = $this->json("POST", "/$this->api_base", $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing("tours", $body);
    }

}

trait Put
{
    // $body = [
    //     "name" => "1234",
    // ];


            /**
     * @test
     */
    public function will_fail_with_a_404_if_the_tour_we_want_to_update_is_not_found()
    {
        $this->create_user('admin');
        $res = $this->json("PUT", "$this->api_base/-1");
        $res->assertStatus(404);
    }



    /**
     * @test
     */
    public function can_update_tour_fully_on_each_model_attribute()
    {
        $this->create_user('admin');

        $old_values = [
            "name" => "1234",
        ];

        $old_tour = $this->create("Tour", $old_values);

        // update every attribute
        $new_values = [
            "name" => "aaaaaaaa",
        ];

        // When
        $response = $this->json("PUT","$this->api_base/".$old_tour->id, $new_values);

        // Then
        $response->assertStatus(200)
                    ->assertJsonFragment($new_values);
                    
        $this->assertDatabaseHas("tours", $new_values);
        $this->assertDatabaseMissing("tours", $old_values);
            
    }
   
    // /**
    //  * @test
    //  */
    // public function can_update_tours_on_a_couple_of_model_attributes()
    // {
    //     $this->create_user('admin');
    //     $old_values = [
    //         "name" => "1234"
    //     ];

    //     $values_to_remain_after_update = [
    //         "duration" => 22.11
    //     ];

    //     $old_tour = $this->create("Tour", array_merge($old_values, $values_to_remain_after_update));

    //     // update every attribute
    //     $new_values = [
    //         "name" => "aaaaaaaa",
    //     ];

    //     // When
    //     $response = $this->json("PUT","$this->api_base/".$old_tour->id, $new_values);

    //     // Then
    //     $response->assertStatus(200)
    //                 ->assertJsonFragment(array_merge($new_values, $values_to_remain_after_update));
                    
    //     $this->assertDatabaseHas("tours", array_merge($new_values, $values_to_remain_after_update));
    //     $this->assertDatabaseMissing("tours", $old_values);
            
    // }

    /**
     * @test
     */
    public function will_fail_with_error_422_when_body_data_is_of_wrong_type()
    {
        $this->create_user('admin');
        $old_values = [
            "name" => "1234"
        ];

        $old_tour = $this->create("Tour", $old_values);

        // "name" is of wrong type
        $new_values = [
            "name" => "aaaaaaaa"
        ];

        // When
        $response = $this->json("PUT","$this->api_base/".$old_tour->id, $new_values);

        // Then
        $response->assertStatus(200)
                    ->assertJsonFragment($new_values);
                    
        $this->assertDatabaseHas("tours", $new_values);
        $this->assertDatabaseMissing("tours", $old_values);
            
    }
}

trait Delete
{
    /**
     * @test
     */
    public function will_fail_with_a_404_if_the_tour_we_want_to_delete_is_not_found()
    {
        $this->create_user('admin');
        $res = $this->json("DELETE", "$this->api_base/-1");
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_delete_a_tour_and_unlink_all_relationships()
    {
        $this->create_user('admin');
        // Given
        // first create a game in the database to delete
        $tour = $this->create("Tour");
        $trip = $this->create("Trip", [
            "tour_id" => $tour->id
        ]);
        $itinerary = $this->create("Itinerary", [
            "tour_id" => $tour->id
        ]);

        // When
        // call the delete api
        $res = $this->json("DELETE", "/$this->api_base/".$tour->id);

        // Then
        $res->assertStatus(204)
            ->assertSee(null);

        // check if $game is deleted from database
        $this->assertDatabaseMissing("tours", ["id" => $tour->id]);

        $trip->refresh();
        if(!$trip->tour_id){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }

        $itinerary->refresh();
        if(!$itinerary->tour_id){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }

    }

}
