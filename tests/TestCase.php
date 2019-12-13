<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    // now we can use $this->create('Model') inside our tests to return a product
    public function create(string $model, array $attributes = [], $resource = true)
    {
        $resource_model = factory("App\\$model")->create($attributes);

        //construct the API resource with $model name
        $resource_class = "App\\Http\\Resources\\$model";

        if(!$resource){
            // simply return created object instead of Api Resource
            return $resource_model;
        }

        return new $resource_class($resource_model);
    }

    public function populate_challenges_with_relations($playfield_type, $game_type, $qty = 1)
    {
        $game_model_str = substr(get_class(config("models.games.$game_type")), 4);
        $game = $this->create($game_model_str, [], false);

        $playfield_type = 'city'; //type doesnt really matter for test.

        $challenge_array = array();
        $count = 0;
        while ($count <= $qty) {
            // create challenge and push to array
            array_push($challenge_array,
                $this->create('Challenge', [
                    'game_type' => $game_type,
                    'game_id' => $game->id,
                    'playfield_type' => $playfield_type
                ])
            );
        }

        return $challenge_array;
    }

    public function populate_itineraries_with_playfield_type($playfield_type, $qty = 1)
    {
        $playfield_model_str = substr(get_class(config("models.games.$playfield_type")), 4);
        $playfield = $this->create($playfield_model_str, [], false);

        $itineraries_array = array();
        $count = 0;
        while ($count <= $qty) {
            // create challenge and push to array
            array_push($itineraries_array,
                $this->create('Itinerary', [
                    'playfield_type' => $playfield_type,
                    'playfield_id' => $playfield->id
                ])
            );
        }

        return $itineraries_array;
    }

}
