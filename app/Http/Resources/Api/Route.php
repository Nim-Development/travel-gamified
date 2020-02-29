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
        \TimeConverter::secondsToDhm($this->duration);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'maps_url' => $this->maps_url,
            'polyline' => $this->polyline,
            'kilometers' => (double)$this->kilometers,
            'duration' => [
                'days' => (!$this->duration) ? 0 : (integer) \TimeConverter::getDays(),
                'hours' => (!$this->duration) ? 0 : (integer) \TimeConverter::getHours(),
                'minutes' => (!$this->duration) ? 0 : (integer) \TimeConverter::getMinutes()
            ],
            'difficulty' => (integer)$this->difficulty,
            'nature' => (integer)$this->nature,
            'highway' => (integer)$this->highway,
            'transit' => (!$transit) ? null : $this->insert_playfield('transit', $this->transit),
            'created_at' => (string)$this->created_at,
        ];
    }
}