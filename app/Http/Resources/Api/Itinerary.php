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
        $tour = $this->tour;

        return [
            'id' => $this->id,
            'title' => (!$playfield) ? null : $playfield->name,
            'tour' => (!$tour) ? null : [
                'id' => (integer)$tour->id,
                'name' => $tour->name,
                'created_at' => (string)$tour->created_at
            ],
            'step' => (integer)$this->step,
            'duration' => (integer)$this->duration,
            'playfield' => (!$playfield) ? null : $this->insert_playfield($this->playfield_type, $playfield),
            'created_at' => (string)$this->created_at,
        ];
    }
}