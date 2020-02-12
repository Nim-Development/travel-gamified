<?php

/**
 * In here we can declare insertion methods that help us insert specific nested arrays for the different
 * use cases per Resource.
 */

namespace App\Http\Resources\Dashboard\_Traits;

trait Insert {

    public function insert_itineraries($itineraries)
    {
        // return null if options collection is empty.
        if(count($itineraries) == 0){ return null; } 

        // function to loop trough options relation and return it as 2d array for insert.
        $itineraries_array = [];
        foreach ($itineraries as $itinerary) {

            $playfield = $itinerary->playfield;
            array_push($itineraries_array,
                [
                    'id' => $itinerary->id,
                    'step' => (int)$itinerary->step,
                    'duration' => (double)$itinerary->duration,
                    'playfield' => (!$playfield) ? null : $this->insert_playfield($itinerary->playfield_type, $playfield),
                    'created_at' => (string)$itinerary->created_at
                ]
            );
        }
        return $itineraries_array;
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
                    'hours' => (double)$playfield->hours,
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
    
    public function insert_routes_into_transit($routes)
    {
        if(count($routes) == 0){ return null; } 

        // function to loop trough routes relation and return it as 2d array for insertion.
        $routes_array = [];
        foreach ($routes as $route) {
            array_push($routes_array,
                [
                    'id' => $route->id,
                    'name' => $route->name,
                    'maps_url' => $route->maps_url,
                    'kilometers' => (double)$route->kilometers,
                    'hours' => (double)$route->hours,
                    'difficulty' => (integer)$route->difficulty,
                    'nature' => (integer)$route->nature,
                    'highway' => (integer)$route->highway,
                    'created_at' => (string)$route->created_at
                ]
            );
        }
        return $routes_array;
    }

    
}