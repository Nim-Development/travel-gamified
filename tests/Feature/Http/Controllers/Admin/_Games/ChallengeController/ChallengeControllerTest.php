<?php

namespace Tests\Feature\Http\Controllers\Admin\Games\ChallengeController;

use Faker\Factory;
use Illuminate\Support\Str;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChallengeControllerTest extends TestCase
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
    // public function non_authenticated_user_can_not_access_challenge_api_endpoints()
    // {
    //     $this->json('GET', '/api/challenges')->assertStatus(401);
    //     $this->json('GET', 'api/challenges/1')->assertStatus(401);
    //     $this->json('PUT', 'api/challenges/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/challenges/1')->assertStatus(401);
    //     $this->json('POST', '/api/challenges')->assertStatus(401);
    // }

}
