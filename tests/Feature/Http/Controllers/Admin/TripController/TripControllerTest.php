<?php

namespace Tests\Feature\Http\Controllers\Admin\TripController;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TripControllerTest extends TestCase
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
    // public function non_authenticated_user_can_not_access_trip_api_endpoints()
    // {
    //     $this->json('GET', '/api/trips')->assertStatus(401);
    //     $this->json('GET', 'api/trips/1')->assertStatus(401);
    //     $this->json('PUT', 'api/trips/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/trips/1')->assertStatus(401);
    //     $this->json('POST', '/api/trips')->assertStatus(401);
    // }




    /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_trip_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/trips/-1');
    //     $res->assertStatus(404);
    // }

        /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_trip_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/trips/-1');
    //     $res->assertStatus(404);
    // }

    /**
     * A basic feature test example.
     * // @test << ::nk Makes it so that we dont have to add test prefix infront of each method!!
     *
     * @test
     *
     */
    // public function can_create_a_trip()
    // {

    //     $faker = Factory::create();

    //     $trip_data = [

    //     ];

    //     $res = $this->json('POST', '/api/trips', $trip_data);

    //     // Then
    //         // Describes the outcome of Action according to conditions in Given

    //     $res->assertJsonStructure([])
    //         ->assertJson($trip_data)
    //         ->assertStatus(201);

    //     // assert if the trip has been added to the database
    //     $this->assertDatabaseHas('trips', $trip_data);

    // }

    /**
     * @test
     */
    // public function can_update_a_trip()
    // {
    //     // Given
    //     $old_trip = $this->create('Trip');

    //     $new_trip = [
    //         'name' => $old_trip->name.'_update',
    //         'slug' => $old_trip->slug.'_update',
    //         'price' => $old_trip->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/trips/'.$old_trip->id,
    //                             $new_trip);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_trip);
    //     $this->assertDatabaseHas('trips', $new_trip);

    // }

    /**
     * @test
     */
    // public function can_delete_a_trip()
    // {
    //     // Given
    //     // first create a trip in the database to delete
    //     $trip = $this->create('Trip');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/trips/'.$trip->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $trip is deleted from database
    //     $this->assertDatabaseMissing('trips', ['id' => $trip->id]);
    // }
}
