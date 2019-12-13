<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CityControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    // public function non_authenticated_user_can_not_access_city_api_endpoints()
    // {
    //     $this->json('GET', '/api/cities')->assertStatus(401);
    //     $this->json('GET', 'api/cities/1')->assertStatus(401);
    //     $this->json('PUT', 'api/cities/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/cities/1')->assertStatus(401);
    //     $this->json('POST', '/api/cities')->assertStatus(401);
    // }

    /**
     * @test
     */
    public function will_fail_with_a_404_if_city_is_not_found()
    {
        $res = $this->json('GET', 'api/cities/-1');
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_city_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/cities/-1');
    //     $res->assertStatus(404);
    // }

        /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_city_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/cities/-1');
    //     $res->assertStatus(404);
    // }

    /**
     * A basic feature test example.
     * // @test << ::nk Makes it so that we dont have to add test prefix infront of each method!!
     *
     * @test
     *
     */
    // public function can_create_a_city()
    // {

    //     $faker = Factory::create();

    //     $citie_data = [

    //     ];

    //     $res = $this->json('POST', '/api/cities', $citie_data);

    //     // Then
    //         // Describes the outcome of Action according to conditions in Given

    //     $res->assertJsonStructure([])
    //         ->assertJson($citie_data)
    //         ->assertStatus(201);

    //     // assert if the cityhas been added to the database
    //     $this->assertDatabaseHas('cities', $citie_data);

    // }

    /**
     * @test
     */
    // public function can_update_a_city()
    // {
    //     // Given
    //     $old_city= $this->create('City');

    //     $new_city= [
    //         'name' => $old_city->name.'_update',
    //         'slug' => $old_city->slug.'_update',
    //         'price' => $old_city->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/cities/'.$old_city->id,
    //                             $new_citie);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_citie);
    //     $this->assertDatabaseHas('cities', $new_citie);

    // }

    /**
     * @test
     */
    // public function can_delete_a_city()
    // {
    //     // Given
    //     // first create a cityin the database to delete
    //     $city= $this->create('City');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/cities/'.$city->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $cityis deleted from database
    //     $this->assertDatabaseMissing('cities', ['id' => $city->id]);
    // }

    /**
     * @test
     */
    public function can_return_a_city()
    {
        // Given
        // inserting a model into the database (we know this will work because test can_create_a_citie() was asserted succesfully)
        $city= $this->create('City');

        // When
        $response = $this->json('GET', "/api/cities/$city->id");

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                    'id' => $city->id,
                    'short_code' => $city->short_code,
                    'name' => $city->name,
                    'created_at' => (string)$city->created_at
                ]);

    }

    /**
     * @test
     */
    public function can_return_a_collection_of_all_cities()
    {
        $citie_1 = $this->create('City');
        $citie_2 = $this->create('City');
        $citie_3 = $this->create('City');
        $citie_4 = $this->create('City');
        $citie_5 = $this->create('City');
        $citie_6 = $this->create('City');

        $response = $this->json('GET', '/api/cities');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections
                            'id', 'short_code', 'name', 'created_at'
                        ]
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_paginated_cities()
    {
        $citie_1 = $this->create('City');
        $citie_2 = $this->create('City');
        $citie_3 = $this->create('City');
        $citie_4 = $this->create('City');
        $citie_5 = $this->create('City');
        $citie_6 = $this->create('City');

        $response = $this->json('GET', '/api/cities/paginate/3');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections
                            'id', 'short_code', 'name', 'created_at'
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
