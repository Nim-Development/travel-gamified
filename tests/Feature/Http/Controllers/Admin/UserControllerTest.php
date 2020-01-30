<?php

namespace Tests\Feature\Http\Controllers\Admin\UserController;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{

    use RefreshDatabase;
    // Include the different tests (seperated by API type)
    use Get;
    use Post;
    use Put;
    use Delete;
    
    protected $api_base = "/api/admin/users";

    /**
     * @test
     */
    public function non_authenticated_user_can_not_access_user_api_endpoints()
    {
        $this->json("GET", "$this->api_base")->assertStatus(401);
        $this->json("GET", "$this->api_base/paginate/10")->assertStatus(401);
        // $this->json("PUT", "$this->api_base/1")->assertStatus(401);
        // $this->json("DELETE", "$this->api_base/1")->assertStatus(401);
        // $this->json("POST", "$this->api_base")->assertStatus(401);
    }

}

trait Get
{
    /**
     * @test
     */
    public function will_fail_with_a_404_if_user_is_not_found()
    {
        $this->create_user('admin');
        $res = $this->json("GET", "$this->api_base/-1");
        $res->assertStatus(404);
    }

    // /**
    //  * @test
    //  */
    // public function will_return_204_when_requesting_all_users_whilst_no_entries_in_database()
    // {
    //     $this->create_user('admin');
    //     // Skip any creates
    //     $res = $this->json("GET", "$this->api_base");
    //     $res->assertStatus(204);
    // }

    // /**
    //  * @test
    //  */
    // public function will_return_204_when_requesting_paginated_users_whilst_no_entries_in_database()
    // {
    //     $this->create_user('admin');
    //     // Skip any creates
    //     $res = $this->json("GET", "$this->api_base/paginate/3");
    //     $res->assertStatus(204);
    // }

        /**
     * @test
     */
    public function returns_a_null_value_on_relationships_if_there_are_no_relationships_available()
    {
        $this->create_user('admin');
        // Given
        $user = $this->create("User");

        // When
        $response = $this->json("GET", "/$this->api_base/".$user->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([ 
                    "data" => [
                        "id" => $user->id,
                        "email" => $user->email,
                        "phone" => $user->phone,
                        "email_verified_at" => (string)$user->email_verified_at,
                        "first_name" => $user->first_name,
                        "family_name" => $user->family_name,
                        "age" => $user->age,
                        "gender" => $user->gender,
                        "score" => $user->score,
                        "team" => null,
                        "trip" => null,
                        "avatar" => null,
                        "created_at" => (string)$user->created_at
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_user()
    {
        $this->create_user('admin');
        // Given
        // inserting a model into the database (we know this will work because test can_create_a_user() was asserted succesfully)
        $team = $this->create("Team");
        $trip = $this->create("Trip");
        $user = $this->create("User", ["team_id" => $team->id, "trip_id" => $trip->id]);

        $this->file_factory($user, "avatar", ["liverpool"]);

        // When
        $response = $this->json("GET", "/$this->api_base/".$user->id);

        // Then
        // assert status code
        $response->assertStatus(200)
                 ->assertExactJson([ 
                    "data" => [
                        "id" => $user->id,
                        "email" => $user->email,
                        "phone" => $user->phone,
                        "email_verified_at" => (string)$user->email_verified_at,
                        "first_name" => $user->first_name,
                        "family_name" => $user->family_name,
                        "age" => $user->age,
                        "gender" => $user->gender,
                        "score" => $user->score,
                        "team" => [
                            "id" => $team->id,
                            "name" => $team->name,
                            "color" => $team->color,
                            "score" => $team->score,
                            "created_at" => (string)$team->created_at
                        ],
                        "trip" => [
                            "id" => $trip->id,
                            "tour_id" => $trip->tour_id,
                            "name" => $trip->name,
                            "start_date_time" => (string)$trip->start_date_time,
                            "created_at" => (string)$trip->created_at,
                        ],
                        "avatar" => [
                            [
                                "def" => $user->getMedia("avatar")[0]->getUrl(),
                                "md" => $user->getMedia("avatar")[0]->getUrl("md"),
                                "sm" => $user->getMedia("avatar")[0]->getUrl("sm"),
                                "thumb" => $user->getMedia("avatar")[0]->getUrl("thumb")
                            ]
                        ],
                        "created_at" => (string)$user->created_at
                    ]
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_all_users()
    {
        $team = $this->create("Team");
        $trip = $this->create("Trip");

        $users = $this->create_collection("User", ["team_id" => $team->id, "trip_id" => $trip->id], false, 6);

        // for auth purposes
        $auth_usr = $this->create_user('admin', ["team_id" => $team->id, "trip_id" => $trip->id]);
        $this->file_factory($auth_usr, "avatar", ["liverpool"]);
        
        foreach($users as $user){
            $this->file_factory($user, "avatar", ["liverpool"]);
        }
        
        $response = $this->json("GET", "/$this->api_base");
        $response->assertStatus(200)
                ->assertJsonCount(7, "data")
                ->assertJsonStructure([
                    "data" => [
                        "*" => [ //* to say we checking keys of multiple collections
                            "id",
                            "email",
                            "phone",
                            "email_verified_at",
                            "first_name",
                            "family_name",
                            "age",
                            "gender",
                            "score",
                            "team" => [
                                "id",
                                "name",
                                "color",
                                "score",
                                "created_at"
                            ],
                            "trip" => [
                                "id",
                                "tour_id",
                                "name",
                                "start_date_time",
                                "created_at"
                            ],
                            "avatar" => [
                                "*" => [
                                    "def",
                                    "md",
                                    "sm",
                                    "thumb"
                                ]
                            ],
                            "created_at"
                        ]
                    ],
                ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_paginated_users()
    {
        $team = $this->create("Team");
        $trip = $this->create("Trip");

        $users = $this->create_collection("User", ["team_id" => $team->id, "trip_id" => $trip->id], false, 6);

        // for auth purposes
        $this->create_user('admin', ["team_id" => $team->id, "trip_id" => $trip->id]);

        foreach($users as $user){
            $this->file_factory($user, "avatar", ["liverpool"]);
        }

        $response = $this->json("GET", "/$this->api_base/paginate/3");

        $response->assertStatus(200)
                ->assertJsonCount(3, "data")
                ->assertJsonStructure([
                    "data" => [
                        "*" => [ //* to say we checking keys of multiple collections
                            "id",
                            "email",
                            "phone",
                            "email_verified_at",
                            "first_name",
                            "family_name",
                            "age",
                            "gender",
                            "score",
                            "team" => [
                                "id",
                                "name",
                                "color",
                                "created_at"
                            ],
                            "trip" => [
                                "id",
                                "tour_id",
                                "name",
                                "start_date_time",
                                "created_at"
                            ],
                            "avatar" => [
                                "*" => [
                                    "def",
                                    "md",
                                    "sm",
                                    "thumb"
                                ]
                            ],
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
     * 
     *  NOTE: THIS STUFF SHOULD BE HANDLED VIA LARAVEL AUTHENTICATION!
     * 
     */

        //

}

trait Put
{
        /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_user_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json("PUT", "$this->api_base/-1");
    //     $res->assertStatus(404);
    // }
    
    /**
     * @test
     */
    // public function can_update_a_user()
    // {
    //     // Given
    //     $old_user = $this->create("User");

    //     $new_user = [
    //         "name" => $old_user->name."_update",
    //         "slug" => $old_user->slug."_update",
    //         "price" => $old_user->price + 3
    //     ];

    //     // When
    //     $response = $this->json("PUT",
    //                             "$this->api_base/".$old_user->id,
    //                             $new_user);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_user);
    //     $this->assertDatabaseHas("users", $new_user);

    // }
}

trait Delete
{
            /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_user_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json("DELETE", "$this->api_base/-1");
    //     $res->assertStatus(404);
    // }


       /**
     * @test
     */
    // public function can_delete_a_user()
    // {
    //     // Given
    //     // first create a user in the database to delete
    //     $user = $this->create("User");

    //     // When
    //     // call the delete api
    //     $res = $this->json("DELETE", "/$this->api_base/".$user->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $user is deleted from database
    //     $this->assertDatabaseMissing("users", ["id" => $user->id]);
    // }
}