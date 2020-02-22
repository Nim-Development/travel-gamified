<?php

namespace App\Http\Resources;

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

        $routes = $this->routes;
        $challenges = $this->challenges;
        $from = $this->from;
        $to = $this->to;

        \TimeConverter::secondsToDhm($this->duration);


        return [
            'id' => $this->id,
            'name' => $this->name,
            "duration" => [
                'days' => (!$this->duration) ? 0 : (integer) \TimeConverter::getDays(),
                'hours' => (!$this->duration) ? 0 : (integer) \TimeConverter::getHours(),
                'minutes' => (!$this->duration) ? 0 : (integer) \TimeConverter::getMinutes()
            ],
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
            'routes' => (!$routes) ? null : $this->insert_routes_into_transit($routes),
            'challenges' => (!$challenges) ? null : $this->insert_challenges_into_transit($challenges),
            'created_at' => (string)$this->created_at
        ];
    }
}