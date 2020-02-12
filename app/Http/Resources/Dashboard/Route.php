<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class Route extends JsonResource
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
        $transit = $this->transit;

        return [
            'label' => $this->name,
            'value' => [
                'id' => $this->id,
                'name' => $this->name,
                'maps_url' => $this->maps_url,
                'kilometers' => (double)$this->kilometers,
                'duration' => (integer)$this->duration,
                'difficulty' => (integer)$this->difficulty,
                'nature' => (integer)$this->nature,
                'highway' => (integer)$this->highway,
                'transit_id' => (!$transit) ? null : $this->transit->id,
                'created_at' => (string)$this->created_at,
            ]
        ];
    }
}