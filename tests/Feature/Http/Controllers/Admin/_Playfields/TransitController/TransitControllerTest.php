<?php

namespace Tests\Feature\Http\Controllers\Admin\Playfields\TransitController;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransitControllerTest extends TestCase
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
    // public function non_authenticated_user_can_not_access_transit_api_endpoints()
    // {
    //     $this->json('GET', '/api/transits')->assertStatus(401);
    //     $this->json('GET', 'api/transits/1')->assertStatus(401);
    //     $this->json('PUT', 'api/transits/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/transits/1')->assertStatus(401);
    //     $this->json('POST', '/api/transits')->assertStatus(401);
    // }

    /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_transit_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/transits/-1');
    //     $res->assertStatus(404);
    // }

        /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_transit_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/transits/-1');
    //     $res->assertStatus(404);
    // }

    /**
     * A basic feature test example.
     * // @test << ::nk Makes it so that we dont have to add test prefix infront of each method!!
     *
     * @test
     *
     */
    // public function can_create_a_transit()
    // {

    //     $faker = Factory::create();

    //     $transit_data = [

    //     ];

    //     $res = $this->json('POST', '/api/transits', $transit_data);

    //     // Then
    //         // Describes the outcome of Action according to conditions in Given

    //     $res->assertJsonStructure([])
    //         ->assertJson($transit_data)
    //         ->assertStatus(201);

    //     // assert if the transit has been added to the database
    //     $this->assertDatabaseHas('Playfields\Transits', $transit_data);

    // }

    /**
     * @test
     */
    // public function can_update_a_transit()
    // {
    //     // Given
    //     $old_transit = $this->create('Playfields\Transit');

    //     $new_transit = [
    //         'name' => $old_transit->name.'_update',
    //         'slug' => $old_transit->slug.'_update',
    //         'price' => $old_transit->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/transits/'.$old_transit->id,
    //                             $new_transit);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_transit);
    //     $this->assertDatabaseHas('Playfields\Transits', $new_transit);

    // }

    /**
     * @test
     */
    // public function can_delete_a_transit()
    // {
    //     // Given
    //     // first create a transit in the database to delete
    //     $transit = $this->create('Playfields\Transit');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/transits/'.$transit->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $transit is deleted from database
    //     $this->assertDatabaseMissing('Playfields\Transits', ['id' => $transit->id]);
    // }
}
