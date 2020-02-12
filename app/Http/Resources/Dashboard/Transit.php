<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class Transit extends JsonResource
{

    use \App\Http\Resources\Dashboard\_Traits\Insert;
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $routes = $this->routes;
        $challenges = $this->challenges;
        $from = $this->from;
        $to = $this->to;

        return [
            'label' => $this->name,
            'value' => [
                'id' => $this->id,
                'name' => $this->name,
                'from' => (!$from) ? null : [
                    'id' => $from->id,
                    'type' => 'city',
                    'short_code' => $from->short_code,
                    'name' => $from->name,
                    'created_at' => (string)$from->created_at
                ],
                'to' => (!$to) ? null : [
                    'id' => $to->id,
                    'type' => 'city',
                    'short_code' => $to->short_code,
                    'name' => $to->name,
                    'created_at' => (string)$to->created_at
                ],
                'routes' => (!$routes) ? null : $this->insert_routes_into_transit($routes),
                'challenge_count' => (!$challenges) ? null : count($challenges),
                'created_at' => (string)$this->created_at
            ]
        ];
    }
}