<?php 

namespace Tests\Feature\Http\Controllers\Admin\Playfields\RouteController;

trait Get
{
    /**
     * @test
     */
    public function will_fail_with_a_404_if_route_is_not_found()
    {
        $res = $this->json('GET', 'api/routes/-1');
        $res->assertStatus(404);
    }

        /**
     * @test
     */
    public function will_return_204_when_requesting_all_routes_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/routes');
        $res->assertStatus(204);
    }

    /**
     * @test
     */
    public function will_return_204_when_requesting_paginated_routes_whilst_no_entries_in_database()
    {
        // Skip any creates
        $res = $this->json('GET', 'api/routes/paginate/3');
        $res->assertStatus(204);
    }

        /**
     * @test
     */
    public function returns_a_null_value_on_relationships_if_there_are_no_relationships_available()
    {

        // Create route without relationship
        $route = $this->create('Playfields\Route');

        // When
        $response = $this->json('GET', '/api/routes/'.$route->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                     'data' => [
                        'id' => $route->id,
                        'name' => $route->name,
                        'maps_url' => $route->maps_url,
                        'kilometers' => $route->kilometers,
                        'hours' => $route->hours,
                        'difficulty' => $route->difficulty,
                        'nature' => $route->nature,
                        'highway' => $route->nature,
                        'transit' => null,
                        'created_at' => (string)$route->created_at,
                    ]
                ]);

    }



    /**
     * @test
     */
    public function can_return_a_route()
    {
        // Given
        $transit = $this->create('Playfields\Transit');

        $route = $this->create('Playfields\Route', ['transit_id' => $transit->id]);

        // When
        $response = $this->json('GET', '/api/routes/'.$route->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([
                     'data' => [
                        'id' => $route->id,
                        'name' => $route->name,
                        'maps_url' => $route->maps_url,
                        'kilometers' => $route->kilometers,
                        'hours' => $route->hours,
                        'difficulty' => $route->difficulty,
                        'nature' => $route->nature,
                        'highway' => $route->nature,
                        'transit' => [
                            'id' => $transit->id,
                            'type' => 'transit',
                            'name' => $transit->name,
                            'from' => $transit->from,
                            'to' => $transit->to,
                            'created_at' => (string)$transit->created_at
                        ],
                        'created_at' => (string)$route->created_at,
                        // 'updated_at' => (string)$route->updated_at
                    ]
                ]);

    }

    /**
     * @test
     */
    public function can_return_a_collection_of_all_routes()
    {
        $transit = $this->create('Playfields\Transit');

        $this->create_collection('Playfields\Route', ['transit_id' => $transit->id], false, 6);

        $response = $this->json('GET', "/api/routes");

        $response->assertStatus(200)
                ->assertJsonCount(6, 'data')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections
                            'id',
                            'name',
                            'maps_url',
                            'kilometers',
                            'hours',
                            'difficulty',
                            'nature',
                            'highway',
                            'transit' => [
                                'id',
                                'type',
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
    public function can_return_a_collection_of_paginated_routes()
    {
        $transit = $this->create('Playfields\Transit');

        $this->create_collection('Playfields\Route', ['transit_id' => $transit->id], false, 6);

        $response = $this->json('GET', "/api/routes/paginate/3");

        $response->assertStatus(200)
                ->assertJsonCount(3, 'data')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections
                            'id',
                            'name',
                            'maps_url',
                            'kilometers',
                            'hours',
                            'difficulty',
                            'nature',
                            'highway',
                            'transit' => [
                                'id',
                                'type',
                                'name',
                                'from',
                                'to',
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
}


