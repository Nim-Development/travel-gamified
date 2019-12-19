<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Faker\Factory;
use Illuminate\Support\Str;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AnswereControllerTest extends TestCase
{

    use RefreshDatabase;

    // /**
    //  * @test
    //  */
    // public function non_authenticated_user_can_not_access_answere_api_endpoints()
    // {
    //     $this->json('GET', '/api/answeres')->assertStatus(401);
    //     $this->json('GET', 'api/answeres/1')->assertStatus(401);
    //     $this->json('PUT', 'api/answeres/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/answeres/1')->assertStatus(401);
    //     $this->json('POST', '/api/answeres')->assertStatus(401);
    // }

    // /**
    //  * @test
    //  */
    public function will_fail_with_a_404_if_answere_is_not_found()
    {
        $res = $this->json('GET', '/api/answeres/checked/-1');
        $res->assertStatus(404);
    }

    // /**
    //  * @test
    //  */
    // public function will_fail_with_a_404_if_the_answere_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/answeres/-1');
    //     $res->assertStatus(404);
    // }

    /**
     * @test
     */
    public function will_fail_with_a_400_if_we_try_to_return_a_single_answere_of_an_invalid_type()
    {
        $res = $this->json('GET', '/api/answeres/xxxx/1');
        $res->assertStatus(400);
    }

    /**
     * @test
     */
    public function will_fail_with_a_400_if_we_try_to_return_all_answeres_of_an_invalid_type()
    {
        $res = $this->json('GET', '/api/answeres/xxxx');
        $res->assertStatus(400);
    }

    /**
     * @test
     */
    public function will_fail_with_a_400_if_we_try_to_return_paginated_answeres_of_an_invalid_type()
    {
        $res = $this->json('GET', '/api/answeres/xxxx/paginate/3');
        $res->assertStatus(400);
    }

    //     /**
    //  * @test
    //  */
    // public function will_fail_with_a_404_if_the_answere_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/answeres/-1');
    //     $res->assertStatus(404);
    // }

    // /**
    //  * A basic feature test example.
    //  * // @test << ::nk Makes it so that we dont have to add test prefix infront of each method!!
    //  *
    //  * @test
    //  *
    //  */
    // public function can_create_a_answere()
    // {

    //     $faker = Factory::create();

    //     $answere_data = [

    //     ];

    //     $res = $this->json('POST', '/api/answeres', $answere_data);

    //     // Then
    //         // Describes the outcome of Action according to conditions in Given

    //     $res->assertJsonStructure([])
    //         ->assertJson($answere_data)
    //         ->assertStatus(201);

    //     // assert if the answere has been added to the database
    //     $this->assertDatabaseHas('answeres', $answere_data);

    // }

    // /**
    //  * @test
    //  */
    // public function can_update_a_answere()
    // {
    //     // Given
    //     $old_answere = $this->create('Answere');

    //     $new_answere = [
    //         'name' => $old_answere->name.'_update',
    //         'slug' => $old_answere->slug.'_update',
    //         'price' => $old_answere->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/answeres/'.$old_answere->id,
    //                             $new_answere);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_answere);
    //     $this->assertDatabaseHas('answeres', $new_answere);

    // }

    // /**
    //  * @test
    //  */
    // public function can_delete_a_answere()
    // {
    //     // Given
    //     // first create a answere in the database to delete
    //     $answere = $this->create('Answere');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/answeres/'.$answere->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $answere is deleted from database
    //     $this->assertDatabaseMissing('answeres', ['id' => $answere->id]);
    // }

    // /**
    //  * @test
    //  */
    // public function can_return_a_answere()
    // {
    //     // Given
    //     // inserting a model into the database (we know this will work because test can_create_a_answere() was asserted succesfully)
    //     $answere = $this->create('Answere');

    //     // When
    //     $response = $this->json('GET', '/api/answeres/'.$answere->id);

    //     // Then
    //     // assert status code
    //     $response->assertStatus(200)
    //              ->assertExactJson([
    //                 'id' => $answere->id,
    //                 'name' => $answere->name,
    //                 'slug' => $answere->slug,
    //                 'price' => $answere->price,
    //                 'created_at' => (string)$answere->created_at,
    //                 // 'updated_at' => (string)$answere->updated_at
    //             ]);

    // }

    // /**
    //  * @test
    //  */
    // public function can_return_a_collection_of_paginated_answeres()
    // {
    //     $answere_1 = $this->create('Answere');
    //     $answere_2 = $this->create('Answere');
    //     $answere_3 = $this->create('Answere');

    //     $response = $this->json('GET', '/api/answeres');

    //     $response->assertStatus(200)
    //             ->assertJsonStructure([
    //                 'data' => [
    //                     '*' => [ //* to say we checking keys of multiple collections

    //                     ]
    //                 ],
    //                 // Check if it is paginated
    //                 'links' => ['first', 'last', 'prev', 'next'],
    //                 'meta' => [
    //                     'current_page', 'last_page', 'from', 'to',
    //                     'path', 'per_page', 'total'
    //                 ]
    //             ]);
    // }

    /**
     * @test
     */
    // public function can_get_all_answeres()
    // {
    //     // creates 6 answeres, and also creates + inserts relational data
    //     $this->collection_of_answeres('AnswereChecked', 6);

    //     $response = $this->json('GET', '/api/answeres/all');

    //     $response->assertStatus(200)
    //             ->assertJsonCount(6, 'data')
    //             ->assertJsonStructure([
    //                 'data' => [
    //                     '*' => [
    //                         'id',
    //                         'answere',
    //                         'score',
    //                         'user' => [
    //                             'id',
    //                             'email',
    //                             'phone',
    //                             'email_verified_at',
    //                             'first_name',
    //                             'family_name',
    //                             'age',
    //                             'gender',
    //                             'score',
    //                             'created_at'
    //                         ],
    //                         'challenge' => [
    //                             'id',
    //                             'sort_order',
    //                             'playfield' => [
    //                                 'id',
    //                                 'short_code',
    //                                 'name'
    //                             ],
    //                             'game' => [
    //                                 'id',
    //                                 'title',
    //                                 'content_media',
    //                                 'content_text',
    //                                 'correct_answere',
    //                                 'points_min',
    //                                 'points_max',
    //                                 'created_at'
    //                             ]
    //                         ]
    //                     ]
    //                 ]
    //             ]);
    // }

    // public function can_get_all_answeres_paginated()
    // {
    //     $this->collection_of_answeres('AnswereChecked', 6);

    //     $response = $this->json('GET', '/api/answeres/{filter}/paginate/3');

    //     $response->assertStatus(200)
    //              ->assertJsonCount(3, 'data')
    //              ->assertJsonStructure([
    //                 'data' => [
    //                     '*' => [
    //                         'id',
    //                         'answere',
    //                         'score',
    //                         'user' => [
    //                             'id',
    //                             'email',
    //                             'phone',
    //                             'email_verified_at',
    //                             'first_name',
    //                             'family_name',
    //                             'age',
    //                             'gender',
    //                             'score',
    //                             'created_at'
    //                         ],
    //                         'challenge' => [
    //                             'id',
    //                             'sort_order',
    //                             'playfield' => [
    //                                 'id',
    //                                 'short_code',
    //                                 'name'
    //                             ],
    //                             'game' => [
    //                                 'id',
    //                                 'title',
    //                                 'content_media',
    //                                 'content_text',
    //                                 'correct_answere',
    //                                 'points_min',
    //                                 'points_max',
    //                                 'created_at'
    //                             ]
    //                         ]
    //                     ]
    //                 ],
    //                 'links' => ['first', 'last', 'prev', 'next'],
    //                 'meta' => [
    //                     'current_page', 'last_page', 'from', 'to',
    //                     'path', 'per_page', 'total'
    //                 ]
    //              ]);
    // }

    /**
     * @test
     */
    public function can_get_all_unchecked_answeres()
    {

        // Create 3 Checked
        $this->collection_of_answeres('AnswereChecked', 3);

        // Create 3 Unchecked
        $this->collection_of_answeres('AnswereUnchecked', 3);

        $response = $this->json('GET', '/api/answeres/unchecked');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'answere',
                            'score',
                            'user' => [
                                'id',
                                'email',
                                'phone',
                                'email_verified_at',
                                'first_name',
                                'family_name',
                                'age',
                                'gender',
                                'score',
                                'created_at'
                            ],
                            'challenge' => [
                                'id',
                                'sort_order',
                                'playfield' => [
                                    'id',
                                    'type',
                                    'short_code',
                                    'name'
                                ],
                                'game' => [
                                    'id',
                                    'type',
                                    'title',
                                    'content_media',
                                    'content_text',
                                    'correct_answere',
                                    'points_min',
                                    'points_max',
                                    'created_at'
                                ]
                            ]
                        ]
                    ]
                 ]);

    }

    /**
     * @test
     */
    public function can_get_all_unchecked_answeres_paginated()
    {
        // Create 3 Checked
        $this->collection_of_answeres('AnswereChecked', 3);

        // Create 3 Unchecked
        $this->collection_of_answeres('AnswereUnchecked', 6);

        $response = $this->json('GET', '/api/answeres/unchecked/paginate/3');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'answere',
                            'score',
                            'user' => [
                                'id',
                                'email',
                                'phone',
                                'email_verified_at',
                                'first_name',
                                'family_name',
                                'age',
                                'gender',
                                'score',
                                'created_at'
                            ],
                            'challenge' => [
                                'id',
                                'sort_order',
                                'playfield' => [
                                    'id',
                                    'type',
                                    'short_code',
                                    'name'
                                ],
                                'game' => [
                                    'id',
                                    'type',
                                    'title',
                                    'content_media',
                                    'content_text',
                                    'correct_answere',
                                    'points_min',
                                    'points_max',
                                    'created_at'
                                ]
                            ]
                        ]
                    ],
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
    public function can_get_all_checked_answeres()
    {
        // Create 3 Checked
        $this->collection_of_answeres('AnswereChecked', 3);

        // Create 3 Unchecked
        $this->collection_of_answeres('AnswereUnchecked', 3);

        $response = $this->json('GET', '/api/answeres/checked');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'answere',
                            'score',
                            'user' => [
                                'id',
                                'email',
                                'phone',
                                'email_verified_at',
                                'first_name',
                                'family_name',
                                'age',
                                'gender',
                                'score',
                                'created_at'
                            ],
                            'challenge' => [
                                'id',
                                'sort_order',
                                'playfield' => [
                                    'id',
                                    'type',
                                    'short_code',
                                    'name'
                                ],
                                'game' => [
                                    'id',
                                    'type',
                                    'title',
                                    'content_media',
                                    'content_text',
                                    'correct_answere',
                                    'points_min',
                                    'points_max',
                                    'created_at'
                                ]
                            ]
                        ]
                    ]
                 ]);
    }

    /**
     * @test
     */
    public function can_get_all_checked_answeres_paginated()
    {
        // Create 3 Checked
        $this->collection_of_answeres('AnswereChecked', 3);

        // Create 3 Unchecked
        $this->collection_of_answeres('AnswereUnchecked', 6);

        $response = $this->json('GET', '/api/answeres/checked/paginate/3');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'answere',
                            'score',
                            'user' => [
                                'id',
                                'email',
                                'phone',
                                'email_verified_at',
                                'first_name',
                                'family_name',
                                'age',
                                'gender',
                                'score',
                                'created_at'
                            ],
                            'challenge' => [
                                'id',
                                'sort_order',
                                'playfield' => [
                                    'id',
                                    'type',
                                    'short_code',
                                    'name'
                                ],
                                'game' => [
                                    'id',
                                    'type',
                                    'title',
                                    'content_media',
                                    'content_text',
                                    'correct_answere',
                                    'points_min',
                                    'points_max',
                                    'created_at'
                                ]
                            ]
                        ]
                    ],
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
    public function can_get_a_single_checked_answere_by_id()
    {

        $challenge = $this->create('Games\Challenge',
            [
                'game_type' => 'text_answere',
                'game_id' => $this->create('Games\GameTextAnswere', [], false)->id,
                'playfield_type' => 'city',
                'playfield_id' => $this->create('Playfields\City', [], false)->id
            ],
            false);
        $user = $this->create('User', [], false);

        $answere = $this->create('AnswereChecked', [
            'challenge_id' => $challenge->id,
            'user_id' => $user->id
        ], false);

        $response = $this->json('GET', "/api/answeres/checked/$answere->id");

        $response->assertStatus(200)
                ->assertJsonFragment(['id' => $answere->id])
                ->assertJsonStructure([
                    'data' => [
                            'id',
                            'answere',
                            'score',
                            'user' => [
                                'id',
                                'email',
                                'phone',
                                'email_verified_at',
                                'first_name',
                                'family_name',
                                'age',
                                'gender',
                                'score',
                                'created_at'
                            ],
                            'challenge' => [
                                'id',
                                'sort_order',
                                'playfield' => [
                                    'id',
                                    'type',
                                    'short_code',
                                    'name'
                                ],
                                'game' => [
                                    'id',
                                    'type',
                                    'title',
                                    'content_media',
                                    'content_text',
                                    'correct_answere',
                                    'points_min',
                                    'points_max',
                                    'created_at'
                                ]
                            ]
                        ]
                ]);
    }

    /**
     * @test
     */
    public function can_get_a_single_unchecked_answere_by_id()
    {
        $challenge = $this->create('Games\Challenge',
            [
                'game_type' => 'text_answere',
                'game_id' => $this->create('Games\GameTextAnswere', [], false)->id,
                'playfield_type' => 'city',
                'playfield_id' => $this->create('Playfields\City', [], false)->id
            ],
            false);

        $user = $this->create('User', [], false);

        $answere = $this->create('AnswereUnchecked', [
            'challenge_id' => $challenge->id,
            'user_id' => $user->id
        ], false);

        $response = $this->json('GET', "/api/answeres/unchecked/$answere->id");

        $response->assertStatus(200)
        ->assertJsonFragment(['id' => $answere->id])
        ->assertJsonStructure([
            'data' => [
                    'id',
                    'answere',
                    'score',
                    'user' => [
                        'id',
                        'email',
                        'phone',
                        'email_verified_at',
                        'first_name',
                        'family_name',
                        'age',
                        'gender',
                        'score',
                        'created_at'
                    ],
                    'challenge' => [
                        'id',
                        'sort_order',
                        'playfield' => [
                            'id',
                            'type',
                            'short_code',
                            'name'
                        ],
                        'game' => [
                            'id',
                            'type',
                            'title',
                            'content_media',
                            'content_text',
                            'correct_answere',
                            'points_min',
                            'points_max',
                            'created_at'
                        ]
                    ]
                ]
        ]);
    }






    // PRIVATE HELPERS
    private function collection_of_answeres($type, $qty)
    {
        // Create a full challenge with all of its relational data inserted.
        $challenge = $this->create(
            'Games\Challenge',
            [
                'game_type' => 'text_answere',
                'game_id' => $this->create('Games\GameTextAnswere', [], false)->id,
                'playfield_type' => 'city',
                'playfield_id' => $this->create('Playfields\City', [], false)->id
            ],
            false
        );

        $user = $this->create('User', [], false);

        return $this->create_collection(
            "$type",
            ['challenge_id' => $challenge->id, 'user_id' => $user->id],
            true,
            $qty
        );
    }

}
