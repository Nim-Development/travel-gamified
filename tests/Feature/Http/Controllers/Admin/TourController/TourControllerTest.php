<?php

namespace Tests\Feature\Http\Controllers\Admin\TourController;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TourControllerTest extends TestCase
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
    // public function non_authenticated_user_can_not_access_tour_api_endpoints()
    // {
    //     $this->json('GET', '/api/tours')->assertStatus(401);
    //     $this->json('GET', 'api/tours/1')->assertStatus(401);
    //     $this->json('PUT', 'api/tours/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/tours/1')->assertStatus(401);
    //     $this->json('POST', '/api/tours')->assertStatus(401);
    // }




    /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_tour_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/tours/-1');
    //     $res->assertStatus(404);
    // }

        /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_tour_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/tours/-1');
    //     $res->assertStatus(404);
    // }

    /**
     * A basic feature test example.
     * // @test << ::nk Makes it so that we dont have to add test prefix infront of each method!!
     *
     * @test
     *
     */
    // public function can_create_a_tour()
    // {

    //     $faker = Factory::create();

    //     $tour_data = [

    //     ];

    //     $res = $this->json('POST', '/api/tours', $tour_data);

    //     // Then
    //         // Describes the outcome of Action according to conditions in Given

    //     $res->assertJsonStructure([])
    //         ->assertJson($tour_data)
    //         ->assertStatus(201);

    //     // assert if the tour has been added to the database
    //     $this->assertDatabaseHas('tours', $tour_data);

    // }

    /**
     * @test
     */
    // public function can_update_a_tour()
    // {
    //     // Given
    //     $old_tour = $this->create('Tour');

    //     $new_tour = [
    //         'name' => $old_tour->name.'_update',
    //         'slug' => $old_tour->slug.'_update',
    //         'price' => $old_tour->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/tours/'.$old_tour->id,
    //                             $new_tour);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_tour);
    //     $this->assertDatabaseHas('tours', $new_tour);

    // }

    /**
     * @test
     */
    // public function can_delete_a_tour()
    // {
    //     // Given
    //     // first create a tour in the database to delete
    //     $tour = $this->create('Tour');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/tours/'.$tour->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $tour is deleted from database
    //     $this->assertDatabaseMissing('tours', ['id' => $tour->id]);
    // }
}
