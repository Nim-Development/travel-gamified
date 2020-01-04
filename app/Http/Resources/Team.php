<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Team extends JsonResource
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

        $users = $this->users;
        $trip = $this->trip;
        
        return [
            'id' => (integer)$this->id,
            'name' => $this->name,
            'color' => $this->color,
            'score' =>  (integer)$this->score,
            'users' => (!$users) ? null : $this->insert_users_into_team($users),
            'trip' => (!$trip) ? null :
                [
                    'id' => (integer)$trip->id,
                    'tour_id' => (integer)$trip->tour_id,
                    'name' => $trip->name,
                    'timezone' => $trip->timezone,
                    'start_date_time' => (string)$trip->start_date_time,
                    'created_at' => (string)$trip->created_at
                ],
            'badge' => $this->insert_media_conversions($this->getMedia('badge')),
            'created_at' => (string)$this->created_at,            
        ];

        
    }
}