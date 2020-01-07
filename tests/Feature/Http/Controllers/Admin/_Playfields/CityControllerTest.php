<?php

namespace Tests\Feature\Http\Controllers\Admin\Playfields\CityController;

use Faker\Factory;
use Tests\TestCase;


use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CityControllerTest extends TestCase
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
    // public function non_authenticated_user_can_not_access_city_api_endpoints()
    // {
    //     $this->json('GET', '/api/cities')->assertStatus(401);
    //     $this->json('GET', 'api/cities/1')->assertStatus(401);
    //     $this->json('PUT', 'api/cities/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/cities/1')->assertStatus(401);
    //     $this->json('POST', '/api/cities')->assertStatus(401);
    // }

}


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

        // add 2 headers
        $this->file_factory($city, 'header', ['liverpool', 'chelsea']);
        // add 2 media contents
        $this->file_factory($city, 'media', ['liverpool', 'chelsea']);

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
                        'header' => [
                            [
                                'def' => $city->getMedia('header')[0]->getUrl(),
                                'md' => $city->getMedia('header')[0]->getUrl('md'),
                                'sm' => $city->getMedia('header')[0]->getUrl('sm'),
                                'thumb' => $city->getMedia('header')[0]->getUrl('thumb'),
                            ],
                            [
                                'def' => $city->getMedia('header')[1]->getUrl(),
                                'md' => $city->getMedia('header')[1]->getUrl('md'),
                                'sm' => $city->getMedia('header')[1]->getUrl('sm'),
                                'thumb' => $city->getMedia('header')[1]->getUrl('thumb'),
                            ]
                        ],
                        'media' => [
                            [
                                'def' => $city->getMedia('media')[0]->getUrl(),
                                'md' => $city->getMedia('media')[0]->getUrl('md'),
                                'sm' => $city->getMedia('media')[0]->getUrl('sm'),
                                'thumb' => $city->getMedia('media')[0]->getUrl('thumb'),
                            ],
                            [
                                'def' => $city->getMedia('media')[1]->getUrl(),
                                'md' => $city->getMedia('media')[1]->getUrl('md'),
                                'sm' => $city->getMedia('media')[1]->getUrl('sm'),
                                'thumb' => $city->getMedia('media')[1]->getUrl('thumb'),
                            ]
                        ],
                        'created_at' => (string)$city->created_at
                     ]
                ]);
    }

    /**
     * @test
     */
    public function returns_null_on_media_attributes_if_there_is_no_media_data_available()
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
                        'header' => null,
                        'media' => null,
                        'created_at' => (string)$city->created_at
                     ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_all_cities()
    {
        $cities = $this->create_collection('Playfields\City', [], $resource = true, $qty = 6);

        foreach($cities as $city){
            $this->file_factory($city, 'header', ['chelsea', 'liverpool']); // add 2 header media files
            $this->file_factory($city, 'media', ['chelsea', 'liverpool']); // add 2 media_content media files    
        }

        $response = $this->json('GET', '/api/cities');
        $response->assertStatus(200)
                ->assertJsonCount(6, 'data')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections
                            'id', 
                            'short_code', 
                            'name',
                           'header' => [
                                '*' => [
                                    'def',
                                    'md',
                                    'sm',
                                    'thumb'
                                ]
                            ],
                            'media' => [
                                '*' => [
                                    'def',
                                    'md',
                                    'sm',
                                    'thumb'
                                ]
                            ],
                            'created_at'
                        ]
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_paginated_cities()
    {
        $cities = $this->create_collection('Playfields\City', [], $resource = true, $qty = 6);

        foreach($cities as $city){
            $this->file_factory($city, 'header', ['chelsea', 'liverpool']); // add 2 header media files
            $this->file_factory($city, 'media', ['chelsea', 'liverpool']); // add 2 media_content media files    
        }

        $response = $this->json('GET', '/api/cities/paginate/3');

        $response->assertStatus(200)
                ->assertJsonCount(3, 'data')
                ->assertJsonStructure([
                    'data' => [
                        '*' => [ //* to say we checking keys of multiple collections
                            'id', 
                            'short_code', 
                            'name', 
                            'header' => [
                                '*' => [
                                    'def',
                                    'md',
                                    'sm',
                                    'thumb'
                                ]
                            ],
                            'media' => [
                                '*' => [
                                    'def',
                                    'md',
                                    'sm',
                                    'thumb'
                                ]
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

trait Post
{
   /**
     * @test
     */
    public function can_create_a_city_with_valid_content_media()
    {
        $body = [
            'short_code' => 'dsf',
            'name' => 'fas af afs asdasd'
        ];
        $files = [          
            'header' => [
                UploadedFile::fake()->image('liverpool.jpg'),
                UploadedFile::fake()->image('chelsea.jpg'),
            ],
            'media' => [
                UploadedFile::fake()->image('barcelona.jpg'),
                UploadedFile::fake()->image('juventus.jpg')
            ]
        ];

        $res = $this->json('POST', '/api/cities', array_merge($body, $files));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                        'short_code',
                        'name',
                        'header' => [
                            '*' => 
                            [
                                'def',
                                'md',
                                'sm',
                                'thumb'
                            ]
                        ],
                        'media' => [
                            '*' => 
                            [
                                'def',
                                'md',
                                'sm',
                                'thumb'
                            ]
                        ],
                        'created_at'
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('cities', $body);

        // assert if the files are uploaded to storage
        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->header)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }

        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->media)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
    }

    // Media are not uploaded directly with a game creation, instead they will be plucked from a local library (Media model)
    /**
     * @test
     */
    public function can_create_a_city_without_media_of_type_header()
    {
        $body = [
            'short_code' => 'dsf',
            'name' => 'fas af afs asdasd'
        ];
        $files = [
            'media' => [
                UploadedFile::fake()->image('barcelona.jpg'),
                UploadedFile::fake()->image('juventus.jpg')
            ]
        ];

        $res = $this->json('POST', '/api/cities', array_merge($body, $files));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                        'short_code',
                        'name',
                        'media' => [
                            '*' => 
                            [
                                'def',
                                'md',
                                'sm',
                                'thumb'
                            ]
                        ],
                        'created_at'
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('cities', $body);

        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->header)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
        // assert if the files are uploaded to storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->media)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
    }

    /**
     * @test
     */
    public function can_create_a_city_without_media_of_type_media()
    {
        $body = [
            'short_code' => 'dsf',
            'name' => 'fas af afs asdasd'
        ];
        $files = [
            'header' => [
                UploadedFile::fake()->image('barcelona.jpg'),
                UploadedFile::fake()->image('juventus.jpg')
            ]
        ];

        $res = $this->json('POST', '/api/cities', array_merge($body, $files));

        // Then
        $res->assertStatus(201)
             ->assertJsonStructure([
                'data' => [
                        'short_code',
                        'name',
                        'header' => [
                            '*' => 
                            [
                                'def',
                                'md',
                                'sm',
                                'thumb'
                            ]
                        ],
                        'media',
                        'created_at'
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('cities', $body);

        // assert if the files are uploaded to storage
        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->header)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }

        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->media)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
    }

    /**
     * @test
     */
    public function can_create_a_city_without_any_media()
    {
        $body = [
            'short_code' => 'dsf',
            'name' => 'fas af afs asdasd'
        ];

        $res = $this->json('POST', '/api/cities', $body);

        // Then
        $res->assertStatus(201)
             ->assertExactJson([
                'data' => [
                        'id' => $res->getData()->data->id,
                        'short_code' => $body['short_code'],
                        'name' => $body['name'],
                        'header' => null,
                        'media' => null,
                        'created_at' => $res->getData()->data->created_at
                ]
            ]);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('cities', $body);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_body_failed_validation_because_of_wrong_data_types()
    {
        // short_code' is wrong data type
        $body = [
            'short_code' => 234,
            'name' => 'fas af afs asdasd'
        ];
        $res = $this->json('POST', '/api/cities', $body);
        $res->assertStatus(422);
        $this->assertDatabaseMissing('cities', $body);
    }

    /**
     * @test
     */
    public function will_fail_with_a_422_if_request_body_failed_validation_because_data_was_missing()
    {
        // short_code' is missing
        $body = [
            'name' => 'fas af afs asdasd'
        ];
        $res = $this->json('POST', '/api/cities', $body);
        $res->assertStatus(422);
        $this->assertDatabaseMissing('cities', $body);
    }
}

trait Put
{

        /**
     * @test
     */
    public function will_fail_with_a_404_if_the_city_we_want_to_update_is_not_found()
    {
        $res = $this->json('PUT', 'api/cities/-1');
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_add_a_header_image_to_end_of_media_collection_from_game_text_answere()
    {
        $old_values = [
            'short_code' => 'dsf',
            'name' => 'fas af afs asdasd'
        ];

        $old_city = $this->create('Playfields\City', $old_values);
        $this->file_factory($old_city, 'header', ['header1', 'header2']);
        
        $files = [
            'header' => [
                UploadedFile::fake()->image('header3.jpg'),
                UploadedFile::fake()->image('header4.jpg'),
            ]
        ];

        // When
        $res = $this->json('PUT','api/cities/'.$old_city->id, $files);

        // Then
        $res->assertStatus(200)
                    ->assertJsonCount(4, 'data.header'); // assert that 2 images have been added to header

        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->header)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
    }
    
    /**
     * @test
     */
    public function can_add_a_media_image_to_end_of_media_collection_from_city()
    {
        $old_values = [
            'short_code' => 'dsf',
            'name' => 'fas af afs asdasd'
        ];

        $old_city = $this->create('Playfields\City', $old_values);
        $this->file_factory($old_city, 'media', ['media1', 'media2']);
        
        $files = [
            'media' => [
                UploadedFile::fake()->image('media3.jpg'),
                UploadedFile::fake()->image('media4.jpg'),
            ]
        ];

        // When
        $res = $this->json('PUT','api/cities/'.$old_city->id, $files);

        // Then
        $res->assertStatus(200)
                    ->assertJsonCount(4, 'data.media'); // assert that 2 images have been added to header

        // Check if db file media data urls actually exist as files in storage
        if($stored_header_files_array = $this->spread_media_urls($res->getData()->data->media)){
            \Storage::disk('test')->assertExists($stored_header_files_array);
        }
    }

    /**
     * @test
     */
    public function can_update_city_fully_on_each_model_attribute()
    {
        // Given
        $old_values = [
            'short_code' => 'dsf',
            'name' => 'fas af afs asdasd'
        ];

        $old_city = $this->create('Playfields\City', $old_values);

        // update every attribute
        $new_values = [
            'short_code' => 'aaaaaaaaa',
            'name' => 'aaaaaaaaa'
        ];

        // When
        $response = $this->json('PUT','api/cities/'.$old_city->id, $new_values);

        // Then
        $response->assertStatus(200)
                    ->assertJsonFragment($new_values);
                    
        $this->assertDatabaseHas('cities', $new_values);
        $this->assertDatabaseMissing('cities', $old_values);
            
    }
   
    /**
     * @test
     */
    public function can_update_game_text_answere_on_a_couple_of_model_attributes()
    {
        
        // Given
        $old_values = [
            'short_code' => 'dsf'
        ];

        $old_values_to_remain_after_update = [
            'name' => 'fas af afs asdasd'
        ];

        $old_city = $this->create('Playfields\City', array_merge($old_values, $old_values_to_remain_after_update));

        // update every attribute
        $new_values = [
            'short_code' => 'aaaaaaaaa',
        ];

        // When
        $response = $this->json('PUT','api/cities/'.$old_city->id, $new_values);

        // Then
        $response->assertStatus(200)
                    ->assertJsonFragment(array_merge($new_values, $old_values_to_remain_after_update));
                    
        // Then
        $response->assertStatus(200)
                    ->assertJsonFragment(array_merge($new_values, $old_values_to_remain_after_update));
                    
        $this->assertDatabaseHas('cities', array_merge($new_values, $old_values_to_remain_after_update));
        $this->assertDatabaseMissing('cities', $old_values);

    }

    /**
     * @test
     */
    public function will_fail_with_error_422_when_body_data_is_of_wrong_type()
    {
        // Given
        $old_values = [
            'short_code' => 'dsf',
            'name' => 'fas af afs asdasd'
        ];

        $old_game = $this->create('Playfields\City', $old_values);

        // 'short_code' is of wrong type
        $new_values = [
            'short_code' => 00001,
            'name' => 'fas af afs asdasd'
        ];

        // When
        $response = $this->json('PUT','api/cities/'.$old_game->id, $new_values);

        // Then
        $response->assertStatus(422);

        $this->assertDatabaseHas('cities', $old_values);          
        $this->assertDatabaseMissing('cities', $new_values);

    }

}

trait Delete
{
    /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_city_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/cities/-1');
    //     $res->assertStatus(404);
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
}