<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Route extends JsonResource
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
        $transit = $this->transit;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'maps_url' => $this->maps_url,
            'kilometers' => (double)$this->kilometers,
            'hours' => (double)$this->hours,
            'difficulty' => (integer)$this->difficulty,
            'nature' => (integer)$this->nature,
            'highway' => (integer)$this->highway,
            'transit' => (!$transit) ? null : $this->insert_playfield('transit', $this->transit),
            'created_at' => (string)$this->created_at,
        ];
    }
}