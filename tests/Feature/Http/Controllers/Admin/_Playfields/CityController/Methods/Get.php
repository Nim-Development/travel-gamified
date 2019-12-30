<?php 

namespace Tests\Feature\Http\Controllers\Admin\Playfields\CityController;

trait Get
{
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
    public function will_return_204_when_requesting_all_cities_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/cities');
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_cities_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/cities/paginate/3');
        $res->assertStatus(204);
    }


    /**
     * @test
     */
    public function can_return_a_city()
    {
        // Given
        // inserting a model into the database (we know this will work because test can_create_a_citie() was asserted succesfully)
        $city = $this->create('Playfields\City');

        // When
        $response = $this->json('GET', "/api/cities/$city->id");

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                     'data' => [
                        'id' => $city->id,
                        'short_code' => $city->short_code,
                        'name' => $city->name,
                        'created_at' => (string)$city->created_at
                     ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_all_cities()
    {
        $this->create_collection('Playfields\City', [], $resource = true, $qty = 6);

        $response = $this->json('GET', '/api/cities');
        $response->assertStatus(200)
                ->assertJsonCount(6, 'data')
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
        $this->create_collection('Playfields\City', [], $resource = true, $qty = 6);

        $response = $this->json('GET', '/api/cities/paginate/3');

        $response->assertStatus(200)
                ->assertJsonCount(3, 'data')
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


