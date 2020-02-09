<?php

namespace Tests\Feature\Http\Controllers\Auth\Passport\PasswordResetController;

use Faker\Factory;
use Tests\TestCase;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\PasswordReset;

class PasswordResetControllerTest extends TestCase
{

    use RefreshDatabase;

    // Include the different tests (seperated by API type)
    use Get;
    use Post;
    use Put;
    use Delete;

    protected $api_base = "api/password/reset";

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
    public function can_find_a_request_token()
    {
        \Artisan::call('passport:install');

        $user_email = 'user@mail.com';
        $reset_token = strtoupper(\Str::random(6));

        // make a password reset token
        $this->create('PasswordReset',[ 'email' => $user_email, 'token' => $reset_token ]);

        $user = $this->create_user('user');
        $res = $this->json("GET", "$this->api_base/find/$reset_token");

        $res->assertStatus(200)
            ->assertJson([
                "data" => [
                    'email' => $user_email,
                    'token' => $reset_token
                ]
            ]);
    }

    /**
     * @test
     */
    public function will_return_404_if_requested_password_request_token_is_not_found()
    {
        \Artisan::call('passport:install');

        // request a token that does not exist
        $user = $this->create_user('user');
        $res = $this->json("GET", "$this->api_base/find/ABCDEF");
        $res->assertStatus(404);
    }
}





trait Post
{

    

    /**
     * @test
     */
    public function will_fail_with_404_if_password_reset_request_email_address_does_not_exist()
    {
        \Artisan::call('passport:install');

        $body = [
            'email' => 'does@not.exist',
        ];
        $res = $this->json("POST", "$this->api_base/request/token", $body);
        $res->assertStatus(404);
    }

    /**
     * @test
     * 
     * //::nk figure out a way to assert that the email has been sent!
     * 
     */
    public function can_request_a_passport_reset_token()
    {
        \Artisan::call('passport:install');

        $body = ['email' => 'user@mail.com'];
        $this->create_user('user', $body);

        $res = $this->json("POST", "$this->api_base/request/token", $body);
        $res->assertStatus(200);
    }


    /**
     * @test
     */
    public function can_update_password_with_a_valid_password_reset_token()
    {
        \Artisan::call('passport:install');

        $email = 'user@mail.com';
        $password = 'secret';
        $password_new = 'secret_new';
        $reset_token = strtoupper(\Str::random(6));

        $this->create('User', [
            'email' => 'user@mail.com',
            'password' => bcrypt($password)
        ]);

        // make a password reset token
        $this->create('PasswordReset',[ 'email' => $email, 'token' => $reset_token ]);

        $body = [
            'email' => $email,
            'password' => $password_new,
            'token' => $reset_token
        ];

        $res = $this->json("POST", "$this->api_base", $body);
        $res->assertStatus(200);

        // assert that can NOT login with old password
        $res1 = $this->json("POST", "api/auth/login", [
            'email' => $email,
            'password' => $password
        ]);
        $res1->assertStatus(401);

        // assert that CAN login with new password
        $res2 = $this->json("POST", "api/auth/login", [
            'email' => $email,
            'password' => $password_new
        ]);
        $res2->assertStatus(200);
    }

    /**
     * @test
     */
    public function will_fail_with_404_if_password_reset_token_is_invalid_at_password_update()
    {
        \Artisan::call('passport:install');

        $email = 'user@mail.com';
        $password = 'secret';
        $password_new = 'secret_new';
        $reset_token = strtoupper(\Str::random(6));

        $this->create('User', [
            'email' => 'user@mail.com',
            'password' => bcrypt($password)
        ]);

        // make a password reset token
        $this->create('PasswordReset',[ 'email' => $email, 'token' => $reset_token ]);

        $body = [
            'email' => $email,
            'password' => $password_new,
            'token' => 'xxxx' // this token does not exist
        ];

        $res = $this->json("POST", "$this->api_base", $body);
        $res->assertStatus(404);

    }

    /**
     * @test
     */
    public function will_fail_with_404_if_user_is_invalid_at_password_update()
    {
        \Artisan::call('passport:install');

        $email = 'user@mail.com';
        $password = 'secret';
        $password_new = 'secret_new';
        $reset_token = strtoupper(\Str::random(6));

        // NO USER IS CREATED
        // ...

        // make a password reset token
        $this->create('PasswordReset',[ 'email' => $email, 'token' => $reset_token ]);

        $body = [
            'email' => $email,
            'password' => $password_new,
            'token' => 'xxxx' // this token does not exist
        ];

        $res = $this->json("POST", "$this->api_base", $body);
        $res->assertStatus(404);
    }


}

trait Put
{

}

trait Delete
{

}