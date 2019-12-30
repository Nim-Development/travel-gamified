<?php

namespace Tests\Feature\Http\Controllers\Admin\TeamController;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamControllerTest extends TestCase
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
    // public function non_authenticated_user_can_not_access_team_api_endpoints()
    // {
    //     $this->json('GET', '/api/teams')->assertStatus(401);
    //     $this->json('GET', 'api/teams/1')->assertStatus(401);
    //     $this->json('PUT', 'api/teams/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/teams/1')->assertStatus(401);
    //     $this->json('POST', '/api/teams')->assertStatus(401);
    // }



    /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_team_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/teams/-1');
    //     $res->assertStatus(404);
    // }

        /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_team_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/teams/-1');
    //     $res->assertStatus(404);
    // }

    /**
     * A basic feature test example.
     * // @test << ::nk Makes it so that we dont have to add test prefix infront of each method!!
     *
     * @test
     *
     */
    // public function can_create_a_team()
    // {

    //     $faker = Factory::create();

    //     $team_data = [

    //     ];

    //     $res = $this->json('POST', '/api/teams', $team_data);

    //     // Then
    //         // Describes the outcome of Action according to conditions in Given

    //     $res->assertJsonStructure([])
    //         ->assertJson($team_data)
    //         ->assertStatus(201);

    //     // assert if the team has been added to the database
    //     $this->assertDatabaseHas('teams', $team_data);

    // }

    /**
     * @test
     */
    // public function can_update_a_team()
    // {
    //     // Given
    //     $old_team = $this->create('Team');

    //     $new_team = [
    //         'name' => $old_team->name.'_update',
    //         'slug' => $old_team->slug.'_update',
    //         'price' => $old_team->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/teams/'.$old_team->id,
    //                             $new_team);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_team);
    //     $this->assertDatabaseHas('teams', $new_team);

    // }

    /**
     * @test
     */
    // public function can_delete_a_team()
    // {
    //     // Given
    //     // first create a team in the database to delete
    //     $team = $this->create('Team');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/teams/'.$team->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $team is deleted from database
    //     $this->assertDatabaseMissing('teams', ['id' => $team->id]);
    // }

}
