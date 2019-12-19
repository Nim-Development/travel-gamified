<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItineraryControllerTest extends TestCase
{

    use RefreshDatabase;


//     Route::get('itineraries', 'Admin\ItineraryController@all');
// Route::get('itineraries/{id}', 'Admin\ItineraryController@single');

    /**
     * @test
     */
    // public function non_authenticated_user_can_not_access_itinerary_api_endpoints()
    // {
    //     $this->json('GET', '/api/itineraries')->assertStatus(401);
    //     $this->json('GET', 'api/itineraries/1')->assertStatus(401);
    //     $this->json('PUT', 'api/itineraries/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/itineraries/1')->assertStatus(401);
    //     $this->json('POST', '/api/itineraries')->assertStatus(401);
    // }

    /**
     * @test
     */
    public function will_fail_with_a_404_if_itinerary_is_not_found()
    {
        $res = $this->json('GET', 'api/itineraries/-1');
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_itinerary_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/itineraries/-1');
    //     $res->assertStatus(404);
    // }

        /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_itinerary_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/itineraries/-1');
    //     $res->assertStatus(404);
    // }

    /**
     * A basic feature test example.
     * // @test << ::nk Makes it so that we dont have to add test prefix infront of each method!!
     *
     * @test
     *
     */
    // public function can_create_a_itinerary()
    // {

    //     $faker = Factory::create();

    //     $itinerarie_data = [

    //     ];

    //     $res = $this->json('POST', '/api/itineraries', $itinerarie_data);

    //     // Then
    //         // Describes the outcome of Action according to conditions in Given

    //     $res->assertJsonStructure([])
    //         ->assertJson($itinerarie_data)
    //         ->assertStatus(201);

    //     // assert if the itinerary has been added to the database
    //     $this->assertDatabaseHas('itineraries', $itinerarie_data);

    // }

    /**
     * @test
     */
    // public function can_update_a_itinerary()
    // {
    //     // Given
    //     $old_itinerary = $this->create('Itinerary');

    //     $new_itinerary = [
    //         'name' => $old_itinerary->name.'_update',
    //         'slug' => $old_itinerary->slug.'_update',
    //         'price' => $old_itinerary->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/itineraries/'.$old_itinerary->id,
    //                             $new_itinerarie);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_itinerarie);
    //     $this->assertDatabaseHas('itineraries', $new_itinerarie);

    // }

    /**
     * @test
     */
    // public function can_delete_a_itinerary()
    // {
    //     // Given
    //     // first create a itinerary in the database to delete
    //     $itinerary = $this->create('Itinerary');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/itineraries/'.$itinerary->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $itinerary is deleted from database
    //     $this->assertDatabaseMissing('itineraries', ['id' => $itinerary->id]);
    // }

    /**
     * @test
     */
    public function can_return_a_itinerary_with_playfield_type_OFF_city()
    {
        // Given
        // Create playfield
        $playfield = $this->create('Playfields\City', [], false);

        $itinerary = $this->create('Itinerary', [
            'playfield_type' => 'city',
            'playfield_id' => $playfield->id
        ]);

        // When
        $response = $this->json('GET', '/api/itineraries/'.$itinerary->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                    'id' => $itinerary->id,
                    'tour_id' => $itinerary->tour_id,
                    'step' => $itinerary->step,
                    'duration' => $itinerary->duration,
                    'playfield_type' => $itinerary->playfield_type,
                    'playfield_id' => $itinerary->playfield_type,
                    'playfield' => [
                        'id' => $playfield->id,
                        'short_code' => $playfield->short_code,
                        'name' => $playfield->name,
                        'created_at' => (string)$playfield->created_at
                    ],
                    'created_at' => (string)$itinerary->created_at,
                    // 'updated_at' => (string)$itinerary->updated_at
                ]);
    }

        /**
     * @test
     */
    public function can_return_a_itinerary_with_playfield_type_OFF_route()
    {
        // Given
        // Create playfield
        $playfield = $this->create('Playfields\Route', [], false);

        $itinerary = $this->create('Itinerary', [
            'playfield_type' => 'route',
            'playfield_id' => $playfield->id
        ]);

        // When
        $response = $this->json('GET', '/api/itineraries/'.$itinerary->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                    'id' => $itinerary->id,
                    'tour_id' => $itinerary->tour_id,
                    'step' => $itinerary->step,
                    'duration' => $itinerary->duration,
                    'playfield_type' => $itinerary->playfield_type,
                    'playfield_id' => $itinerary->playfield_type,
                    'playfield' => [
                        'id' => $playfield->id,
                        'transit_id' => $playfield->transit_id,
                        'name' => $playfield->name,
                        'maps_url' => $playfield->maps_url,
                        'kilometers' => $playfield->kilometers,
                        'hours' => $playfield->hours,
                        'difficulty' => $playfield->difficulty,
                        'nature' => $playfield->nature,
                        'highway' => $playfield->highway,
                        'created_at' => (string)$playfield->created_at
                    ],
                    'created_at' => (string)$itinerary->created_at,
                    // 'updated_at' => (string)$itinerary->updated_at
                ]);
    }

            /**
     * @test
     */
    public function can_return_a_itinerary_with_playfield_type_OFF_transit()
    {
        // Given
        // Create playfield
        $playfield = $this->create('Playfields\Transit', [], false);

        $itinerary = $this->create('Itinerary', [
            'playfield_type' => 'transit',
            'playfield_id' => $playfield->id
        ]);

        // When
        $response = $this->json('GET', '/api/itineraries/'.$itinerary->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                    'id' => $itinerary->id,
                    'tour_id' => $itinerary->tour_id,
                    'step' => $itinerary->step,
                    'duration' => $itinerary->duration,
                    'playfield_type' => $itinerary->playfield_type,
                    'playfield_id' => $itinerary->playfield_type,
                    'playfield' => [
                        'id' => $playfield->id,
                        'name' => $playfield->name,
                        'from' => $playfield->from,
                        'to' => $playfield->to,
                        'created_at' => (string)$playfield->created_at
                    ],
                    'created_at' => (string)$itinerary->created_at,
                    // 'updated_at' => (string)$itinerary->updated_at
                ]);
    }

    // Route::get('itineraries', 'Admin\ItineraryController@all');


    /**
     * @test
     */
    public function can_return_a_collection_of_all_itineraries()
    {

        $city = $this->create('Playfields\City');

        $this->create_collection('Itinerary', ['playfield_type' => 'city', 'playfield_id' => $city->id], false, 3);

        $response = $this->json('GET', "api/initineraries");

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                            'id',
                            'tour_id',
                            'step',
                            'duration',
                            'playfield_type',
                            'playfield_id',
                            'playfield' => [
                                'id',
                                'name',
                                'from',
                                'to',
                                'created_at'
                            ],
                            'created_at'
                        ]
                    ]
                 ]);
    }

        /**
     * @test
     */
    public function can_return_a_collection_of_all_itineraries_paginated()
    {

        $city = $this->create('Playfields\City');
        $this->create_collection('Itinerary', ['playfield_type' => 'city', 'playfield_id' => $city->id], false, 6);

        $response = $this->json('GET', "api/initineraries/paginate/3");

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                        '*' => [ //* to say we checking keys of multiple collections
                                'id',
                                'tour_id',
                                'step',
                                'duration',
                                'playfield_type',
                                'playfield_id',
                                'playfield' => [
                                    'id',
                                    'short_code',
                                    'name',
                                    'created_at'
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
    public function can_return_a_collection_of_all_itineraries_with_playfield_OFF_city()
    {
        $transit = $this->create('Playfields\Transit');
        $this->create_collection('Itinerary', ['playfield_type' => 'transit', 'playfield_id' => $transit->id], false, 6);

        // create 1 more itinerary with other playfield type
        $this->create('Itinerary', ['playfield_type' => 'city']);

        $response = $this->json('GET', "api/initineraries/playfield/$playfield_type");

        // Assert if all itineraries have relation of type Transit
        $this->assert_if_all_objects_have_same_type_in_specified_relation($response, 'playfield', 'transit');
        $response->assertStatus(200)
                 ->assertJsonCount(6, 'data')
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                            'id',
                            'tour_id',
                            'step',
                            'duration',
                            'playfield_type',
                            'playfield_id',
                            'playfield' => [
                                'id',
                                'name',
                                'from',
                                'to',
                                'created_at'
                            ],
                            'created_at'
                         ]
                     ]
                 ]);
    }

        /**
     * @test
     */
    public function can_return_a_collection_of_all_itineraries_with_playfield_OFF_route()
    {
        $playfield_type = 'route';
        $qty = 3;
        // create 3 challenges with game type of multple_choice
        $itineraries = $this->populate_itineraries_with_playfield_type($playfield_type, $qty);

        // create 1 more challenge with other playfield type
        $this->create('Itinerary', ['playfield_type' => 'xxxx']);


        $response = $this->json('GET', "api/initineraries/playfield/$playfield_type");

        $response->assertStatus(200)
                 ->assertJsonCount($qty, 'data')
                 ->assertJsonHas($itineraries);
    }

            /**
     * @test
     */
    public function can_return_a_collection_of_all_itineraries_with_playfield_OFF_transit()
    {
        $playfield_type = 'transit';
        $qty = 3;
        // create 3 challenges with game type of multple_choice
        $itineraries = $this->populate_itineraries_with_playfield_type($playfield_type, $qty);

        // create 1 more challenge with other playfield type
        $this->create('Itinerary', ['playfield_type' => 'xxxx']);

        $response = $this->json('GET', "api/initineraries/playfield/$playfield_type");

        $response->assertStatus(200)
                 ->assertJsonCount($qty, 'data')
                 ->assertJsonHas($itineraries);
    }



    /////////////
    // PRIVATE //
    /////////////
    private function assert_if_all_objects_have_same_type_in_specified_relation($response, $relation_type, $given)
    {
        // asserts the nested $type property for game or playfield.
        foreach($response->getData()->data as $itinerary){
            $this->assertSame($given, $itinerary->$relation_type->type);
        }
    }

}
