<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $polymorph_map = [
        'media_upload' => 'Games\GameMediaUpload',
        'multiple_choice' => 'Games\GameMultipleChoice',
        'text_answere' => 'Games\GameTextAnswere',
        'city' => 'Playfields\City',
        'route' => 'Playfields\Route',
        'transit' => 'Playfields\Transit'
    ];

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

    public function create_collection(string $model, array $attributes = [], $resource = true, $qty = 1)
    {

        $resource_model_array = factory("App\\$model", $qty)->create($attributes);

        //construct the API resource collection with $model name
        $resource_collection_class = "App\\Http\\Resources\\".$model;

        if(!$resource){
            // simply return array of model objects instead of as resource collection
            return $resource_model_array;
        }

        // return resource collection
        return $resource_collection_class::collection($resource_model_array);
    }

    // takes a collection of transits and inserts the complex relational stuff for each of them.
    public function insert_relations_into_transit_collection($transits, $game_type)
    {
        foreach($transits as $transit){
            /** Link 2 Routes to transit */
            ;
            $this->create('Playfields\Route', ['transit_id' => $transit->id]);

            // insert game into challenge and link the challenge to $transit.
            $this->create('Games\Challenge', [
                    'game_type' => $game_type, 
                    'game_id' => $this->create($this->polymorph_map[$game_type])->id,
                    'playfield_type' => 'transit',
                    'playfield_id' => $transit->id
                ]);
            
            // insert game into challenge and link the challenge to $transit.
            $game_2 = $this->create('Games\GameTextAnswere');
            $this->create('Games\Challenge', [
                'game_type' => $game_type, 
                'game_id' => $this->create($this->polymorph_map[$game_type])->id,
                'playfield_type' => 'transit',
                'playfield_id' => $transit->id
            ]);

            // link itinerary to Transit
            $this->create('Itinerary', [
                'playfield_type' => 'transit',
                'playfield_id' => $transit->id
            ]);
        }
    }

    // takes a collection of transits and inserts the complex relational stuff for each of them.
    public function insert_relations_into_trip_collection($trips)
    {
        foreach($trips as $trip){
            $trip->tour_id = $this->create('Tour')->id;
            $trip->save();

            // create 2 teams, link them to trip
            $team = $this->create('Team', ['trip_id' => $trip->id]);
    
            // create 4 users, link them to trip and team
            $this->create('User', ['trip_id' => $trip->id, 'team_id' => $team->id]);
            $this->create('User', ['trip_id' => $trip->id, 'team_id' => $team->id]);
        }
    }

    public function collection_of_challenges($playfield_type, $game_type, $qty)
    {

        return $this->create_collection(
            'Games\Challenge',
            [
                'game_type' => $game_type,
                'game_id' => $this->create($this->polymorph_map[$game_type], [], false)->id,
                'playfield_type' => $playfield_type,
                'playfield_id' => $this->create($this->polymorph_map[$playfield_type], [], false)->id
            ],
            true,
            $qty
        );
    }

    public function assert_if_all_objects_have_same_type_in_specified_relation($response, $relation_type, $given)
    {
        // asserts the nested $type property for game or playfield.
        foreach($response->getData()->data as $item){
            $this->assertSame($given, $item->$relation_type->type);
        }
    }

    public function collection_of_answeres($type, $qty)
    {
        // Create a full challenge with all of its relational data inserted.
        $challenge = $this->create(
            'Games\Challenge',
            [
                'game_type' => 'text_answere',
                'game_id' => $this->create('Games\GameTextAnswere', [], false)->id,
                'playfield_type' => 'city',
                'playfield_id' => $this->create('Playfields\City', [], false)->id
            ],
            false
        );

        $user = $this->create('User', [], false);

        return $this->create_collection(
            "$type",
            ['challenge_id' => $challenge->id, 'user_id' => $user->id],
            true,
            $qty
        );
    }

    public function link_options_to_each_game_collection_item($game_collection, $options_qty)
    {
        // loop over each game in game collection
        foreach ($game_collection as $game) {
            // create $qty x options and give them game_id of currently looped game
            $this->create_collection('Games\GameMultipleChoiceOption', ['game_id' => $game->id], true, $options_qty);
        }
    }
}
