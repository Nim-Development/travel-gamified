<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Itinerary extends JsonResource
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
        $playfield = $this->playfield;

        return [
            'id' => $this->id,
            'tour_id' => (integer)$this->tour_id,
            'step' => (integer)$this->step,
            'duration' => (double)$this->duration,
            'playfield' => (!$playfield) ? null : $this->insert_playfield($this->playfield_type, $playfield),
            'created_at' => (string)$this->created_at,
        ];
    }
}