<?php

namespace Tests\Feature\Http\Controllers\Admin\ItineraryController;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItineraryControllerTest extends TestCase
{

    use RefreshDatabase;
    // Include the different tests (seperated by API type)
    use Get;
    use Post;
    use Put;
    use Delete;

//     Route::get('itineraries', 'Admin\ItineraryController@all');
// Route::get('itineraries/{id}', 'Admin\ItineraryController@single');

    /**
     * @test
     */
    // public function non_authenticated_user_can_not_access_itinerary_api_endpoints()
    // {
    //     $this->json('GET', '/api/itineraries')->assertStatus(401);
    //     $this->json('GET', 'api/itineraries/1')->assertStatus(401);
    //     $this->json('PUT', 'api/itineraries/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/itineraries/1')->assertStatus(401);
    //     $this->json('POST', '/api/itineraries')->assertStatus(401);
    // }


    /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_itinerary_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/itineraries/-1');
    //     $res->assertStatus(404);
    // }

        /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_itinerary_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/itineraries/-1');
    //     $res->assertStatus(404);
    // }

    /**
     * A basic feature test example.
     * // @test << ::nk Makes it so that we dont have to add test prefix infront of each method!!
     *
     * @test
     *
     */
    // public function can_create_a_itinerary()
    // {

    //     $faker = Factory::create();

    //     $itinerarie_data = [

    //     ];

    //     $res = $this->json('POST', '/api/itineraries', $itinerarie_data);

    //     // Then
    //         // Describes the outcome of Action according to conditions in Given

    //     $res->assertJsonStructure([])
    //         ->assertJson($itinerarie_data)
    //         ->assertStatus(201);

    //     // assert if the itinerary has been added to the database
    //     $this->assertDatabaseHas('itineraries', $itinerarie_data);

    // }

    /**
     * @test
     */
    // public function can_update_a_itinerary()
    // {
    //     // Given
    //     $old_itinerary = $this->create('Itinerary');

    //     $new_itinerary = [
    //         'name' => $old_itinerary->name.'_update',
    //         'slug' => $old_itinerary->slug.'_update',
    //         'price' => $old_itinerary->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/itineraries/'.$old_itinerary->id,
    //                             $new_itinerarie);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_itinerarie);
    //     $this->assertDatabaseHas('itineraries', $new_itinerarie);

    // }

    /**
     * @test
     */
    // public function can_delete_a_itinerary()
    // {
    //     // Given
    //     // first create a itinerary in the database to delete
    //     $itinerary = $this->create('Itinerary');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/itineraries/'.$itinerary->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $itinerary is deleted from database
    //     $this->assertDatabaseMissing('itineraries', ['id' => $itinerary->id]);
    // }

}
