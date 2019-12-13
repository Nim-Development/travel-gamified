<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TourControllerTest extends TestCase
{

    use RefreshDatabase;


    /**
     * @test
     */
    // public function non_authenticated_user_can_not_access_tour_api_endpoints()
    // {
    //     $this->json('GET', '/api/tours')->assertStatus(401);
    //     $this->json('GET', 'api/tours/1')->assertStatus(401);
    //     $this->json('PUT', 'api/tours/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/tours/1')->assertStatus(401);
    //     $this->json('POST', '/api/tours')->assertStatus(401);
    // }

    /**
     * @test
     */
    public function will_fail_with_a_404_if_tour_is_not_found()
    {
        $res = $this->json('GET', 'api/tours/-1');
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_tour_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/tours/-1');
    //     $res->assertStatus(404);
    // }

        /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_tour_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/tours/-1');
    //     $res->assertStatus(404);
    // }

    /**
     * A basic feature test example.
     * // @test << ::nk Makes it so that we dont have to add test prefix infront of each method!!
     *
     * @test
     *
     */
    // public function can_create_a_tour()
    // {

    //     $faker = Factory::create();

    //     $tour_data = [

    //     ];

    //     $res = $this->json('POST', '/api/tours', $tour_data);

    //     // Then
    //         // Describes the outcome of Action according to conditions in Given

    //     $res->assertJsonStructure([])
    //         ->assertJson($tour_data)
    //         ->assertStatus(201);

    //     // assert if the tour has been added to the database
    //     $this->assertDatabaseHas('tours', $tour_data);

    // }

    /**
     * @test
     */
    // public function can_update_a_tour()
    // {
    //     // Given
    //     $old_tour = $this->create('Tour');

    //     $new_tour = [
    //         'name' => $old_tour->name.'_update',
    //         'slug' => $old_tour->slug.'_update',
    //         'price' => $old_tour->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/tours/'.$old_tour->id,
    //                             $new_tour);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_tour);
    //     $this->assertDatabaseHas('tours', $new_tour);

    // }

    /**
     * @test
     */
    // public function can_delete_a_tour()
    // {
    //     // Given
    //     // first create a tour in the database to delete
    //     $tour = $this->create('Tour');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/tours/'.$tour->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $tour is deleted from database
    //     $this->assertDatabaseMissing('tours', ['id' => $tour->id]);
    // }

    /**
     * @test
     */
    public function can_return_a_tour()
    {
        // Given
        // inserting a model into the database (we know this will work because test can_create_a_tour() was asserted succesfully)
        $tour = $this->create('Tour');

        // When
        $response = $this->json('GET', '/api/tours/'.$tour->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                    'id' => $tour->id,
                    'name' => $tour->name,
                    'duration' => $tour->duration,
                    'created_at' => (string)$tour->created_at,

                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_all_tours()
    {
        $tour_1 = $this->create('Tour');
        $tour_2 = $this->create('Tour');
        $tour_3 = $this->create('Tour');

        $response = $this->json('GET', '/api/tours');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id', 'name', 'duration', 'created_at'
                        ]
                    ],
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_paginated_tours()
    {
        $tour_1 = $this->create('Tour');
        $tour_2 = $this->create('Tour');
        $tour_3 = $this->create('Tour');
        $tour_4 = $this->create('Tour');
        $tour_5 = $this->create('Tour');
        $tour_6 = $this->create('Tour');

        $response = $this->json('GET', '/api/tours/paginate/3');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections
                            'id', 'name', 'duration', 'created_at'
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
}
