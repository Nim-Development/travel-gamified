<?php

/**
 * In here we can declare insertion methods that help us insert specific nested arrays for the different
 * use cases per Resource.
 */

namespace App\Http\Resources\_Traits;

trait Insert {
    public function insert_game($game_type, $game)
    {
        switch ($game_type) {
            case 'media_upload':
                return [
                    'id' => $game->id,
                    'type' => $game_type,
                    'title' => $game->title,
                    'content_text' => $game->content_text,
                    'media_type' => $game->media_type,
                    'correct_answere' => $game->correct_answere,
                    'points_min' => (integer)$game->points_min,
                    'points_max' => (integer)$game->points_max,
                    'created_at' => (string)$game->created_at
                ];
                break;

            case 'multiple_choice':
                return [
                    'id' => $game->id,
                    'type' => $game_type,
                    'title' => $game->title,
                    'content_text' => $game->content_text,
                    'correct_answere' => $game->correct_answere,
                    'points_min' => (integer)$game->points_min,
                    'points_max' => (integer)$game->points_max,
                    'created_at' => (string)$game->created_at
                ];
                break;

            case 'text_answere':
                return [
                    'id' => $game->id,
                    'type' => $game_type,
                    'title' => $game->title,
                    'content_text' => $game->content_text,
                    'correct_answere' => $game->correct_answere,
                    'points_min' => (integer)$game->points_min,
                    'points_max' => (integer)$game->points_max,
                    'created_at' => (string)$game->created_at
                ];
                break;
        }
    }

    public function insert_playfield($playfield_type, $playfield)
    {
        switch ($playfield_type) {
            case 'city':
                return [
                    'id' => $playfield->id,
                    'type' => $playfield_type,
                    'short_code' => $playfield->short_code,
                    'name' => $playfield->name,
                    'created_at' => (string)$playfield->created_at
                ];
                break;

            case 'route':
                return [
                    'id' => $playfield->id,
                    'type' => $playfield_type,
                    'transit_id' => (!$playfield->transit_id) ? null : (integer)$playfield->transit_id,
                    'name' => $playfield->name,
                    'maps_url' => $playfield->maps_url,
                    'kilometers' => (double)$playfield->kilometers,
                    'duration' => (integer)$playfield->duration,
                    'difficulty' => (integer)$playfield->difficulty,
                    'nature' => (integer)$playfield->nature,
                    'highway' => (integer)$playfield->highway,
                    'created_at' => (string)$playfield->created_at
                ];
                break;

            case 'transit':
                return [
                    'id' => $playfield->id,
                    'type' => $playfield_type,
                    'name' => $playfield->name,
                    'from' => (!$playfield->from) ? null : [
                        'id' => $playfield->from->id,
                        'type' => 'city',
                        'short_code' => $playfield->from->short_code,
                        'name' => $playfield->from->name,
                        'created_at' => (string)$playfield->from->created_at
                    ],
                    'to' => (!$playfield->to) ? null : [
                        'id' => $playfield->to->id,
                        'type' => 'city',
                        'short_code' => $playfield->to->short_code,
                        'name' => $playfield->to->name,
                        'created_at' => (string)$playfield->to->created_at
                    ],
                    'created_at' => (string)$playfield->created_at
                ];
                break;
        }
    }

    public function insert_options($options)
    {

        // return null if options collection is empty.
        if(count($options) == 0){ return null; } 

        // function to loop trough options relation and return it as 2d array for insert.
        $options_array = [];
        foreach ($options as $option) {
            array_push($options_array,
                [
                    'id' => $option->id,
                    'sort_order' => $option->sort_order,
                    'text' => $option->text,
                    'created_at' => (string)$option->created_at
                ]
            );
        }
        return $options_array;
    }

    public function insert_itineraries($itineraries)
    {

        // return null if options collection is empty.
        if(count($itineraries) == 0){ return null; } 

        // function to loop trough options relation and return it as 2d array for insert.
        $itineraries_array = [];
        foreach ($itineraries as $itinerary) {
            // convert duration to days, hours, minutes
            \TimeConverter::secondsToDhm($itinerary->duration);
            
            array_push($itineraries_array,
                [
                    'id' => $itinerary->id,
                    'step' => (int)$itinerary->step,
                    'duration' => [
                        'days' => (integer) \TimeConverter::getDays(),
                        'hours' => (integer) \TimeConverter::getHours(),
                        'minutes' => (integer) \TimeConverter::getMinutes()
                    ],
                    'playfield_type' => $itinerary->playfield_type,
                    'playfield_id' => $itinerary->playfield_id,
                    'created_at' => (string)$itinerary->created_at
                ]
            );
        }
        return $itineraries_array;
    }

    public function insert_users_into_team($users)
    {
        if(count($users) == 0){ return null; } 

        // function to loop trough options relation and return it as 2d array for insert.
        $users_array = [];
        foreach ($users as $user) {
            array_push($users_array,
                [
                    'id' => (integer)$user->id,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'first_name' => $user->first_name,
                    'family_name' => $user->family_name,
                    'age' => (integer)$user->age,
                    'gender' => $user->gender,
                    'score' => (integer)$user->score,
                    'created_at' => (string)$user->created_at
                ]
            );
        }
        return $users_array;
    }

    public function insert_users_into_trip($users)
    {
        if(count($users) == 0){ return null; } 

        // function to loop trough options relation and return it as 2d array for insert.
        $users_array = [];
        foreach ($users as $user) {
            array_push($users_array,
                [
                    'id' => (integer)$user->id,
                    'team_id' => (!$user->team_id) ? null : (integer)$user->team_id,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'first_name' => $user->first_name,
                    'family_name' => $user->family_name,
                    'age' => (integer)$user->age,
                    'gender' => $user->gender,
                    'score' => (integer)$user->score,
                    'created_at' => (string)$user->created_at
                ]
            );
        }
        return $users_array;
    }

    public function insert_teams_into_trip($teams)
    {
        if(count($teams) == 0){ return null; } 

        $teams_array = [];
        foreach ($teams as $team) {
            array_push($teams_array,
                [
                    'id' => (integer)$team->id,
                    'name' => $team->name,
                    'color' => $team->color,
                    'score' => (integer)$team->score,
                    'created_at' => (string)$team->created_at
                ]
            );
        }
        return $teams_array;
    }

    public function insert_routes_into_transit($routes)
    {
        if(count($routes) == 0){ return null; } 

        // function to loop trough routes relation and return it as 2d array for insertion.
        $routes_array = [];
        foreach ($routes as $route) {
            
            // convert seconds to days, hours, minutes
            \TimeConverter::secondsToDhm($route->duration);

            array_push($routes_array,
                [
                    'id' => $route->id,
                    'name' => $route->name,
                    'maps_url' => $route->maps_url,
                    'polyline' => $route->polyline,
                    'kilometers' => (double)$route->kilometers,
                    'duration' => [
                        'days' => (!$route->duration) ? 0 : (integer) \TimeConverter::getDays(),
                        'hours' => (!$route->duration) ? 0 : (integer) \TimeConverter::getHours(),
                        'minutes' => (!$route->duration) ? 0 : (integer) \TimeConverter::getMinutes()
                    ],
                    'difficulty' => (integer)$route->difficulty,
                    'nature' => (integer)$route->nature,
                    'highway' => (integer)$route->highway,
                    'created_at' => (string)$route->created_at
                ]
            );
        }
        return $routes_array;
    }

    public function insert_media_conversions($media_collection)
    {
        if(count($media_collection) == 0){ return null; } 

        // function to loop trough routes relation and return it as 2d array for insertion.
        $media_collection_array = [];
        foreach ($media_collection as $media_collection_item) {
            array_push($media_collection_array,
                [
                    'def' => $media_collection_item->getUrl(),
                    'md' => $media_collection_item->getUrl('md'),
                    'sm' => $media_collection_item->getUrl('sm'),
                    'thumb' => $media_collection_item->getUrl('thumb')
                ]
            );
        }
        return $media_collection_array;
    }

    // checks if single media item is empty and returns null if true.
    public function single_media($media_collection){
        if($media_collection->isEmpty()){
            return null;
        }
        return $media_collection[0];
    }

    public function insert_challenges_into_transit($challenges)
    {
        if(count($challenges) == 0){ return null; } 

        // function to loop trough routes relation and return it as 2d array for insertion.
        $challenges_array = [];
        foreach ($challenges as $challenge) {
            array_push($challenges_array,
                [
                    'id' => (integer)$challenge->id,
                    'sort_order' => (integer)$challenge->sort_order,
                    'game' => [
                        'id' => (integer)$challenge->game->id,
                        'type' => $challenge->game->type,
                        'title' => $challenge->game->title,
                        'content_text' => $challenge->game->content_text,
                        'correct_answere' => $challenge->game->correct_answere,
                        'points_min' => (integer)$challenge->game->points_min,
                        'points_max' => (integer)$challenge->game->points_max,
                        'created_at' => (string)$challenge->game->created_at
                    ],
                    'created_at' => (string)$challenge->created_at
                ]
            );
        }
        return $challenges_array;
    }
}