<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class Itinerary extends JsonResource
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
        $playfield = $this->playfield;
        $tour = $this->tour;

        return [
            'title' => (!$this->playfield) ? null : $this->playfield->name, // used in ReactJS: <SortableTree />
            'id' => $this->id,
            'step' => (integer)$this->step,
            'duration' => (double)$this->duration,
            'playfield' => (!$playfield) ? null : $this->insert_playfield($this->playfield_type, $playfield),
            'created_at' => (string)$this->created_at,
        ];
    }
}