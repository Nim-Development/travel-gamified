<?php 

namespace Tests\Feature\Http\Controllers\Admin\Games\ChallengeController;

trait Put
{
    // /**
    //  * @test
    //  */
    // public function will_fail_with_a_404_if_the_challenge_we_want_to_update_is_not_found()
    // {
    //     $res = $this->json('PUT', 'api/challenges/-1');
    //     $res->assertStatus(404);
    // }

    // /**
    //  * @test
    //  */
    // public function can_update_a_challenge()
    // {
    //     // Given
    //     $old_challenge = $this->create('Challenge');

    //     $new_challenge = [
    //         'name' => $old_challenge->name.'_update',
    //         'slug' => $old_challenge->slug.'_update',
    //         'price' => $old_challenge->price + 3
    //     ];

    //     // When
    //     $response = $this->json('PUT',
    //                             'api/challenges/'.$old_challenge->id,
    //                             $new_challenge);
    //     // Then
    //     $response->assertStatus(200)
    //              ->assertJsonFragment($new_challenge);
    //     $this->assertDatabaseHas('challenges', $new_challenge);

    // }

}