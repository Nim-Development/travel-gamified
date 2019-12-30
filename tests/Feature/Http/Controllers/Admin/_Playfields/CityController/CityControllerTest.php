<?php

namespace Tests\Feature\Http\Controllers\Admin\Playfields\CityController;

use Faker\Factory;
use Illuminate\Support\Str;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CityControllerTest extends TestCase
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
    // public function non_authenticated_user_can_not_access_city_api_endpoints()
    // {
    //     $this->json('GET', '/api/cities')->assertStatus(401);
    //     $this->json('GET', 'api/cities/1')->assertStatus(401);
    //     $this->json('PUT', 'api/cities/1')->assertStatus(401);
    //     $this->json('DELETE', 'api/cities/1')->assertStatus(401);
    //     $this->json('POST', '/api/cities')->assertStatus(401);
    // }

    /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_city_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/cities/-1');
    //     $res->assertStatus(404);
    // }

        /**
     * @test
     */
    // public function will_fail_with_a_404_if_the_city_we_want_to_delete_is_not_found()
    // {
    //     $res = $this->json('DELETE', 'api/cities/-1');
    //     $res->assertStatus(404);
    // }

    /**
     * A basic feature test example.
     * // @test << ::nk Makes it so that we dont have to add test prefix infront of each method!!
     *
     * @test
     *
     */
    // public function can_create_a_city()
    // {

    //     $faker = Factory::create();

    //     $citie_data = [

    //     ];

    //     $res = $this->json('POST', '/api/cities', $citie_data);

    //     // Then
    //         // Describes the outcome of Action according to conditions in Given

    //     $res->assertJsonStructure([])
    //         ->assertJson($citie_data)
    //         ->assertStatus(201);

    //     // assert if the cityhas been added to the database
    //     $this->assertDatabaseHas('cities', $citie_data);

    // }

    /**
     * @test
     */
    // public function can_update_a_city()
    // {
    //     // Given
    //     $old_city= $this->create('City');

    //     $new_city= [
    //         'name' => $old_city->name.'_update',
    //         'slug' => $old_city->slug.'_update',
    //         'price' => $old_city->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/cities/'.$old_city->id,
    //                             $new_citie);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_citie);
    //     $this->assertDatabaseHas('cities', $new_citie);

    // }

    /**
     * @test
     */
    // public function can_delete_a_city()
    // {
    //     // Given
    //     // first create a cityin the database to delete
    //     $city= $this->create('City');

    //     // When
    //     // call the delete api
    //     $res = $this->json('DELETE', '/api/cities/'.$city->id);

    //     // Then
    //     $res->assertStatus(204)
    //         ->assertSee(null);

    //     // check if $cityis deleted from database
    //     $this->assertDatabaseMissing('cities', ['id' => $city->id]);
    // }

}
