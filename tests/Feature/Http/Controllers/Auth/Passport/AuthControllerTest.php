<?php

namespace Tests\Feature\Http\Controllers\Auth\Passport\AuthController;

use Faker\Factory;
use Tests\TestCase;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends TestCase
{

    use RefreshDatabase;

    // Include the different tests (seperated by API type)
    use Get;
    use Post;
    use Put;
    use Delete;

    protected $api_base = "/api/auth";

    /**
     * @test
     */
    // public function non_authenticated_user_can_not_access_game_api_endpoints()
    // {
    //     $this->json("GET", "/api/games")->assertStatus(401);
    //     $this->json("GET", "api/games/1")->assertStatus(401);
    //     $this->json("PUT", "api/games/1")->assertStatus(401);
    //     $this->json("DELETE", "api/games/1")->assertStatus(401);
    //     $this->json("POST", "/api/games")->assertStatus(401);
    // }

}


trait Get
{
    
    /**
     * @test
     */
    public function can_get_own_user_details()
    {
        \Artisan::call('passport:install');

        $user = $this->create_user('user');
        $res = $this->json("GET", "$this->api_base/details");

        $res->assertStatus(200)
            ->assertJson([
                "data" => [
                    "id" => $user->id,
                    "email" => $user->email,
                    "phone" => $user->phone,
                    "email_verified_at" => $user->email_verified_at,
                    "first_name" => $user->first_name,
                    "family_name" => $user->family_name,
                    "age" => $user->age,
                    "gender" => $user->gender,
                    "score" => $user->score,
                    "team" => null,
                    "trip" => null,
                    "avatar" => null,
                    "created_at" => $user->created_at
                ]
            ]);
    }

    /**
     * @test
     */
    public function will_return_401_if_requesting_user_data_by_unauthorized_user()
    {
        $this->json('GET', "$this->api_base/details")
            ->assertStatus(401);
    }

    /**
     * @test
     * 
     * Passport::actingAs() does not work in this case, because we need to pass Bearer token directly as Header.
     * 
     */
    public function is_able_to_logout()
    {
        \Artisan::call('passport:install');

        $user = $this->create('User', [], false);
        
        $token = $user->createToken('access_token')->accessToken;
        $header = [
            'Authorization' => "Bearer $token"
        ];

        //first log out
        $res = $this->json('GET', "$this->api_base/logout", [], $header);
        $res->assertStatus(204);
    }
}





trait Post
{
    /**
     * @test
     */
    public function will_fail_with_401_if_login_credentials_are_incorrect()
    {
        \Artisan::call('passport:install');

        $body = [
            'email' => 'does@not.exist',
            'password' => 'does_not_exist'
        ];
        $res = $this->json("POST", "$this->api_base/login", $body);
        $res->assertStatus(401);
    }

    /**
     * @test
     */
    public function will_fail_with_422_if_wrong_data_type_is_given_to_login_request()
    {
        \Artisan::call('passport:install');

        $body = [
            'email' => -1,
            'password' => 'abcd'
        ];

        $res = $this->json("POST", "$this->api_base/login", $body);
        $res->assertStatus(401);
    }

    /**
     * @test
     */
    public function can_register_a_new_user()
    {
        \Artisan::call('passport:install');
        $body = [
            'first_name' => 'Nick', 
            'family_name' => 'Knierim', 
            'age' => '26',
            'gender' => 'male',
            'email' => 'user@mail.com',
            'phone' => '123456789',
            'password' => 'secret', 
            'c_password' => 'secret', 
            'is_admin' => false,
            'score' => 0
        ];

        $res = $this->json("POST", "$this->api_base/register", $body);
        $res->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                        "id",
                        "email",
                        "phone",
                        "email_verified_at",
                        "first_name",
                        "family_name",
                        "age",
                        "gender",
                        "score",
                        "team",
                        "trip",
                        "avatar",
                        "created_at",
                ],
                    "token"
                ]);

        $this->assertDatabaseHas('users', ['first_name' => 'Nick']);

    }


    /**
     * @test
     */
    public function can_login_an_existing_user()
    {
        \Artisan::call('passport:install');

        $body = [
            'email' => 'test@mail.com',
            'password' => 'secret'
        ];
        $user = $this->create('User', ['email' => $body['email'], 'password' => bcrypt($body['password'])]);
        // $user->createToken('access_token');

        $res = $this->json("POST", "$this->api_base/login", $body);
        $res->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                        "id",
                        "email",
                        "phone",
                        "email_verified_at",
                        "first_name",
                        "family_name",
                        "age",
                        "gender",
                        "score",
                        "team",
                        "trip",
                        "avatar",
                        "created_at",
                ],
                    "token"
                ]);

    }

    // Route::post('user/update/password', 'AuthController@update_password');

    /**
     * @test
     */
    public function can_update_a_password()
    {
        \Artisan::call('passport:install');

        $email = 'user@mail.com';
        $password = 'secret';
        $password_new = 'secret_new';
        $user = $this->create_user('user', ['password' => bcrypt($password), 'email' => $email]);
        
        $body = [
            'old_password' => $password,
            'new_password' => $password_new, 
            'c_new_password' => $password_new
        ];
        // $header = $this->header_with_access_token($user);
        $res1 = $this->json('POST', "$this->api_base/update/password", $body);
        $res1->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                    "id",
                    "email",
                    "phone",
                    "email_verified_at",
                    "first_name",
                    "family_name",
                    "age",
                    "gender",
                    "score",
                    "team",
                    "trip",
                    "avatar",
                    "created_at",
            ],
                "token"
        ]);
    }

        /**
     * @test
     */
    public function can_destroy_a_user()
    {
        \Artisan::call('passport:install');

        $data = ['first_name' => 'Nick', 'family_name' => 'Knierim'];
        $this->create_user('user', $data);
        
        $res = $this->json('DELETE', "$this->api_base/delete");

        $this->assertDatabaseMissing('users', $data);
    }

    // return response()->json([
    //     'data' => new UserResource($user), 
    //     'token' => $token
    // ], 200); 
    //     }
    //     else {
    //         return response()->json(['error' => 'old password is incorrect.'], 401);
    //     }
    //     }
    //     return response()->json(['error' => 'old password is incorrect.'], 401);
}

trait Put
{

}

trait Delete
{

}