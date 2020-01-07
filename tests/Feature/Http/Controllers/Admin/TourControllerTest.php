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

}


trait Get
{
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
    public function will_return_204_when_requesting_all_tours_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/tours');
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_tours_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/tours/paginate/3');
        $res->assertStatus(204);
    }

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
                     'data' => [
                        'id' => $tour->id,
                        'name' => $tour->name,
                        'duration' => $tour->duration,
                        'created_at' => (string)$tour->created_at
                     ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_all_tours()
    {

        $this->create_collection('Tour', [], false, 6);

        $response = $this->json('GET', '/api/tours');

        $response->assertStatus(200)
                ->assertJsonCount(6, 'data')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id', 
                            'name', 
                            'duration', 
                            'created_at'
                        ]
                    ],
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_paginated_tours()
    {
        $this->create_collection('Tour', [], false, 6);

        $response = $this->json('GET', '/api/tours/paginate/3');
        $response->assertStatus(200)
                ->assertJsonCount(3, 'data')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id', 
                            'name', 
                            'duration', 
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
}


trait Post
{

         /**
     * @test
     */
    public function can_create_a_tour()
    {

        $body = [
            'name' => '1234',
            'duration' => 22.11
        ];

        $res = $this->json('POST', '/api/tours', $body);

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'duration',
                    'created_at'
                ]
        ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('tours', $body);
    }

             /**
     * @test
     */
    public function will_fail_with_error_422_if_request_body_data_is_of_wrong_type()
    {
        // 'name' is of wrong type
        $body = [
            'name' => 111,
            'duration' => 22.11
        ];

        $res = $this->json('POST', '/api/tours', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('tours', $body);
    }

    /**
     * @test
     */
    public function will_fail_with_error_422_if_request_body_data_is_missing()
    {
        // 'name' is missing
        $body = [
            'duration' => 22.11
        ];

        $res = $this->json('POST', '/api/tours', $body);

        // Then
        $res->assertStatus(422);

        // assert if the game has been added to the database
        $this->assertDatabaseMissing('tours', $body);
    }

}

trait Put
{
    // $body = [
    //     'name' => '1234',
    //     'duration' => 22.11
    // ];


            /**
     * @test
     */
    public function will_fail_with_a_404_if_the_tour_we_want_to_update_is_not_found()
    {
        $res = $this->json('PUT', 'api/tours/-1');
        $res->assertStatus(404);
    }



    /**
     * @test
     */
    public function can_update_tour_fully_on_each_model_attribute()
    {

        $old_values = [
            'name' => '1234',
            'duration' => 22.11
        ];

        $old_tour = $this->create('Tour', $old_values);

        // update every attribute
        $new_values = [
            'name' => 'aaaaaaaa',
            'duration' => 00.01
        ];

        // When
        $response = $this->json('PUT','api/tours/'.$old_tour->id, $new_values);

        // Then
        $response->assertStatus(200)
                    ->assertJsonFragment($new_values);
                    
        $this->assertDatabaseHas('tours', $new_values);
        $this->assertDatabaseMissing('tours', $old_values);
            
    }
   
    /**
     * @test
     */
    public function can_update_tours_on_a_couple_of_model_attributes()
    {
        $old_values = [
            'name' => '1234'
        ];

        $values_to_remain_after_update = [
            'duration' => 22.11
        ];

        $old_tour = $this->create('Tour', array_merge($old_values, $values_to_remain_after_update));

        // update every attribute
        $new_values = [
            'name' => 'aaaaaaaa',
        ];

        // When
        $response = $this->json('PUT','api/tours/'.$old_tour->id, $new_values);

        // Then
        $response->assertStatus(200)
                    ->assertJsonFragment(array_merge($new_values, $values_to_remain_after_update));
                    
        $this->assertDatabaseHas('tours', array_merge($new_values, $values_to_remain_after_update));
        $this->assertDatabaseMissing('tours', $old_values);
            
    }

    /**
     * @test
     */
    public function will_fail_with_error_422_when_body_data_is_of_wrong_type()
    {
        $old_values = [
            'name' => '1234',
            'duration' => 22.11
        ];

        $old_tour = $this->create('Tour', $old_values);

        // 'name' is of wrong type
        $new_values = [
            'name' => 'aaaaaaaa'
        ];

        // When
        $response = $this->json('PUT','api/tours/'.$old_tour->id, $new_values);

        // Then
        $response->assertStatus(200)
                    ->assertJsonFragment($new_values);
                    
        $this->assertDatabaseHas('tours', $new_values);
        $this->assertDatabaseMissing('tours', $old_values);
            
    }
}

trait Delete
{
            /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_tour_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/tours/-1');
    //     $res->assertStatus(404);
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
}
