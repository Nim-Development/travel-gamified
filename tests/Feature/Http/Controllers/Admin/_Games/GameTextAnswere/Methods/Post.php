<?php 

namespace Tests\Feature\Http\Controllers\Admin\Games\GameTextAnswereController;

trait Post
{
    /**
     * @test
     */
    public function can_create_a_text_answere_game_with_a_valid_content_media_link_attached()
    {
        $body = [
            'title' => 'dsfsdvafs',
            'content_media' => 'unit_test_media.png', // 'unit_test_media.png' exists in storage, for testing.
            'content_text' => 'fas af afs asdasd as',
            'correct_answere' => 'fsadfafa fas as dfasdfas asdfas dfasfa das',
            'points_min' => 123423,
            'points_max' => 123456
        ];

        $res = $this->json('POST', '/api/games', $body);

        // Then
        $res->assertJson($body)
            ->assertStatus(201);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('game_text_answeres', $body);
    }

        // Media are not uploaded directly with a game creation, instead they will be plucked from a local library (Media model)
    /**
     * @test
     */
    public function can_create_a_text_answere_game_without_a_content_media_link_attached()
    {
        $body = [
            'title' => 'dsfsdvafs',
            'content_media' => null,
            'content_text' => 'fas af afs asdasd as',
            'correct_answere' => 'fsadfafa fas as dfasdfas asdfas dfasfa das',
            'points_min' => 123423,
            'points_max' => 123456
        ];

        $res = $this->json('POST', '/api/games', $body);

        // Then
        $res->assertJson($body)
            ->assertStatus(201);

        // assert if the game has been added to the database
        $this->assertDatabaseHas('game_text_answeres', $body);
    }

    /**
     * @test
     */
    public function will_fail_with_a_400_if_request_body_failed_validation()
    {
        // do a few different failed request bodies
        // 'title' & 'points_min' are wrong data type
        $body_1 = [
            'title' => 1234,
            'content_media' => '213dasadsads',
            'content_text' => 'dsaakmcs',
            'correct_answere' => 'dsaakmcs',
            'points_min' => 'dsaakmcs',
            'points_max' => 12345,
        ];
        $res = $this->json('POST', '/api/games', $body_1);
        $res->assertStatus(400);
        $this->assertDatabaseMissing('game_text_answeres', $body_1);

        // 'content_media' is missing
        $body_2 = [
            'title' => 'sadasdff',
            'content_text' => 'dsaakmcs',
            'correct_answere' => 'dsaakmcs',
            'points_min' => 12343,
            'points_max' => 12345,
        ];
        $res = $this->json('POST', '/api/games', $body_2);
        $res->assertStatus(400);
        $this->assertDatabaseMissing('game_text_answeres', $body_2);

    }

    /**
     * @test
     */
    public function will_fail_with_a_400_if_creation_request_uses_a_invallid_content_media_link()
    {
        $body = [
            'title' => 'fdhshuifhs fsdhui',
            'content_media' => 'THIS_MEDIA_DOES_NOT_EXIST.png',
            'content_text' => 'dsj a uhdfg hfiughgifud hugfaidhiuagf ga',
            'correct_answere' => 'kjdfgh kjhfds hjd os ie is djojks.',
            'points_min' => 123456,
            'points_max' => 123458
        ];

        $res = $this->json('POST', '/api/games', $body);

        // Then
            // Describes the outcome of Action according to conditions in Given

        $res->assertStatus(400);
        $this->assertDatabaseMissing('game_text_answeres', $body);

    }

    /**
     * @test
     */
    public function will_fail_with_a_409_if_request_tries_to_make_a_duplicate_database_insertion()
    {
        //
    }


}