<?php 

namespace Tests\Feature\Http\Controllers\Admin\TourController;

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


