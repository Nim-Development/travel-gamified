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

        if(!is_null($tour)){
            // convert seconds to days, hours, minutes
            \TimeConverter::secondsToDhm($tour->duration);
            $tour_days = \TimeConverter::getDays();
            $tour_hours = \TimeConverter::getHours();
            $tour_minutes = \TimeConverter::getMinutes();
        }
        
        \TimeConverter::clear();
        \TimeConverter::secondsToDhm($this->duration);

        return [
            'id' => $this->id,
            'title' => (!$playfield) ? null : $playfield->name,
            'tour' => (!$tour) ? null : [
                'id' => (integer)$tour->id,
                'name' => $tour->name,
                'duration' => [
                    'days' => (!$tour->duration) ? 0 : (integer) $tour_days,
                    'hours' => (!$tour->duration) ? 0 : (integer) $tour_hours,
                    'minutes' => (!$tour->duration) ? 0 : (integer) $tour_minutes
                ],
                'created_at' => (string)$tour->created_at
            ],
            'step' => (integer)$this->step,
            'duration' => [
                'days' => (integer) \TimeConverter::getDays(),
                'hours' => (integer) \TimeConverter::getHours(),
                'minutes' => (integer) \TimeConverter::getMinutes()
            ],
            'playfield' => (!$playfield) ? null : $this->insert_playfield($this->playfield_type, $playfield),
            'created_at' => (string)$this->created_at,
        ];
    }
}