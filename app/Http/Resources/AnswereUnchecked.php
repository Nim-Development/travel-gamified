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
        $playfield = $challenge->playfield;
        $game = $challenge->game;

        return [
            'id' => $this->id,
            'answere' => $this->answere,
            'score' => $this->score,
            'created_at' => (string)$this->created_at,
            'user' => [
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
            'challenge' => [
                'id' => $challenge->id,
                'sort_order' => $challenge->sort_order,
                'playfield' => [
                    'id' => $playfield->id,
                    'type' => $challenge->playfield_type,
                    'short_code' => $playfield->short_code,
                    'name' => $playfield->name,
                    'created_at' => (string)$playfield->created_at
                ],
                'game' => [
                    'id' => $game->id,
                    'type' => $challenge->game_type,
                    'title' => $game->title,
                    'content_media' => $game->content_media,
                    'content_text' => $game->content_text,
                    'correct_answere' => $game->correct_answere,
                    'points_min' => $game->points_min,
                    'points_max' => $game->points_max,
                    'created_at' => (string)$game->created_at
                ]
            ]
        ];
    }
}
