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

        // convert seconds to days, hours, minutes
        \TimeConverter::secondsToDhm($this->duration);

        return [
            'title' => (!$this->playfield) ? null : $this->playfield->name, // used in ReactJS: <SortableTree />
            'id' => $this->id,
            'step' => (integer)$this->step,
            'duration' => [
                'days' => (!$this->duration) ? 0 : (integer) \TimeConverter::getDays(),
                'hours' => (!$this->duration) ? 0 : (integer) \TimeConverter::getHours(),
                'minutes' => (!$this->duration) ? 0 : (integer) \TimeConverter::getMinutes()
            ],
            'playfield' => (!$playfield) ? null : $this->insert_playfield($this->playfield_type, $playfield),
            'created_at' => (string)$this->created_at,
            // 'days' => ,
            // 'hours' => ,
            // 'minutes' => 
        ];
    }
}