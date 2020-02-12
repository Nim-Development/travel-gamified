<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Trip extends JsonResource
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

        $tour = $this->tour;
        $teams = $this->teams;
        $users = $this->users;

        return [
            'id' => (integer)$this->id,
            'name' => $this->name,
            'timezone' => (string)$this->timezone,
            'start_date_time' => (string)$this->start_date_time,
            'tour' => (!$tour) ? null :
                [
                    'id' => (integer)$tour->id,
                    'name' => $tour->name,
                    'duration' => (double)$tour->duration,
                    'created_at' => (string)$tour->created_at
                ],
            'teams' => (!$teams) ? null : $this->insert_teams_into_trip($teams),
            'users' => (!$users) ? null : $this->insert_users_into_trip($users),
            'created_at' => (string)$this->created_at
        ];
    }
}

