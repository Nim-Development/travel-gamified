<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswereUnchecked extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $user = $this->user;
        $challenge = $this->challenge;

        return [
            'id' => $this->id,
            'answere' => $this->answere,
            'score' => $this->score,
            'created_at' => (string)$this->created_at,
            'user' => (!$user) ? null :
                [
                    'id' => $user->id,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'email_verified_at' => $user->email_verified_at,
                    'first_name' => $user->first_name,
                    'family_name' => $user->family_name,
                    'age' => $user->age,
                    'gender' => $user->gender,
                    'score' => $user->score,
                    'created_at' => (string)$user->created_at
                ],
            'challenge' => (!$challenge) ? null :
                [
                    'id' => $challenge->id,
                    'sort_order' => $challenge->sort_order,
                    'playfield' => (!$challenge->playfield) ? null :
                        [
                            'id' => $challenge->playfield->id,
                            'type' => $challenge->playfield_type,
                            'short_code' => $challenge->playfield->short_code,
                            'name' => $challenge->playfield->name,
                            'created_at' => (string)$challenge->playfield->created_at
                        ],
                    'game' => (!$challenge->game) ? null :
                        [
                            'id' => $challenge->game->id,
                            'type' => $challenge->game_type,
                            'title' => $challenge->game->title,
                            'content_media' => $challenge->game->content_media,
                            'content_text' => $challenge->game->content_text,
                            'correct_answere' => $challenge->game->correct_answere,
                            'points_min' => $challenge->game->points_min,
                            'points_max' => $challenge->game->points_max,
                            'created_at' => (string)$challenge->game->created_at
                        ]
                ]
        ];
    }
}
