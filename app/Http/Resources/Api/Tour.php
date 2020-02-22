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

        // convert seconds to days, hours, minutes
        \TimeConverter::secondsToDhm($this->duration);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'duration' => [
                'days' => (!$this->duration) ? 0 : (integer) \TimeConverter::getDays(),
                'hours' => (!$this->duration) ? 0 : (integer) \TimeConverter::getHours(),
                'minutes' => (!$this->duration) ? 0 : (integer) \TimeConverter::getMinutes()
            ],
            'itineraries' => (!$itineraries) ? null : $this->insert_itineraries($itineraries),
            'created_at' => (string)$this->created_at,
        ];
    }
}