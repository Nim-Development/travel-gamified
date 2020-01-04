<?php

namespace App\Http\Resources\Playfields;

use Illuminate\Http\Resources\Json\JsonResource;

class Transit extends JsonResource
{

    use \App\Http\Resources\_Traits\Insert;
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $itinerary = $this->itinerary;
        $routes = $this->routes;
        $challenges = $this->challenges;
        $from = $this->from;
        $to = $this->to;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'from' => [
                'id' => $from->id,
                'type' => 'city',
                'short_code' => $from->short_code,
                'name' => $from->name,
                'created_at' => (string)$from->created_at
            ],
            'to' => [
                'id' => $to->id,
                'type' => 'city',
                'short_code' => $to->short_code,
                'name' => $to->name,
                'created_at' => (string)$to->created_at
            ],
            'itinerary' => (!$itinerary) ? null :
                [
                    'id' => $itinerary->id,
                    'step' => (integer)$itinerary->step,
                    'duration' => (double)$itinerary->duration,
                    'created_at' => (string)$itinerary->created_at
                ],
            'routes' => (!$routes) ? null : $this->insert_routes_into_transit($routes),
            'challenges' => (!$challenges) ? null : $this->insert_challenges_into_transit($challenges),
            'created_at' => (string)$this->created_at
        ];
    }
}