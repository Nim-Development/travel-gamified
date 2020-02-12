<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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

        $team = $this->team;
        $trip = $this->trip;

        return [
            'id' => $this->id,
            'email' => $this->email,
            'phone' => $this->phone,
            'email_verified_at' => (string)$this->email_verified_at,
            'first_name' => $this->first_name,
            'family_name' => $this->family_name,
            'age' => (integer)$this->age,
            'gender' => $this->gender,
            'score' => (integer)$this->score,
            'team' => (!$team) ? null :
                [
                    'id' => $team->id,
                    'name' => $team->name,
                    'color' => $team->color,
                    'score' => (integer)$team->score,
                    'created_at' => (string)$team->created_at
                ],
            'trip' => (!$trip) ? null :
                [
                    'id' => $trip->id,
                    'tour_id' => (!$trip->tour_id) ? null : (integer)$trip->tour_id,
                    'name' => $trip->name,
                    'start_date_time' => $trip->start_date_time,
                    'created_at' => (string)$trip->created_at,
                ],
            'avatar' => $this->insert_media_conversions($this->getMedia('avatar')),
            'created_at' => (string)$this->created_at
        ];
    }
}
