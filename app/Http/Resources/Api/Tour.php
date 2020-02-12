<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Tour extends JsonResource
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
        $itineraries = $this->itineraries;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'duration' => (double)$this->duration,
            'itineraries' => (!$itineraries) ? null : $this->insert_itineraries($itineraries),
            'created_at' => (string)$this->created_at,
        ];
    }
}