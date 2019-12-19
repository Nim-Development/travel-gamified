<?php

namespace App\Http\Resources\Games;

use Illuminate\Http\Resources\Json\JsonResource;

class Challenge extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $playfield = $this->playfield;
        $game = $this->game;

        return [
            'id' => $this->id,
            'sort_order' => (integer)$this->sort_order,
            'playfield' => $this->insert_playfield($this->playfield_type, $playfield),
            'game' => $this->insert_game($this->game_type, $game),
            'created_at' => (string)$this->created_at,
        ];
    }

    /////////////
    // HELPERS //
    /////////////
    private function insert_game($game_type, $game)
    {
        switch ($game_type) {
            case 'media_upload':
                return [
                    'id' => $game->id,
                    'type' => $game_type,
                    'title' => $game->title,
                    'content_media' => $game->content_media,
                    'content_text' => $game->content_text,
                    'media_type' => $game->media_type,
                    'correct_answere' => $game->correct_answere,
                    'points_min' => (integer)$game->points_min,
                    'points_max' => (integer)$game->points_max,
                    'created_at' => (string)$game->created_at
                ];
                break;

            case 'multiple_choice':
                return [
                    'id' => $game->id,
                    'type' => $game_type,
                    'title' => $game->title,
                    'content_media' => $game->content_media,
                    'content_text' => $game->content_text,
                    'correct_answere' => $game->correct_answere,
                    'points_min' => (integer)$game->points_min,
                    'points_max' => (integer)$game->points_max,
                    'created_at' => (string)$game->created_at
                ];
                break;

            case 'text_answere':
                return [
                    'id' => $game->id,
                    'type' => $game_type,
                    'title' => $game->title,
                    'content_media' => $game->content_media,
                    'content_text' => $game->content_text,
                    'correct_answere' => $game->correct_answere,
                    'points_min' => (integer)$game->points_min,
                    'points_max' => (integer)$game->points_max,
                    'created_at' => (string)$game->created_at
                ];
                break;
        }
    }

    public function insert_playfield($playfield_type, $playfield)
    {
        switch ($playfield_type) {
            case 'city':
                return [
                    'id' => $playfield->id,
                    'type' => $playfield_type,
                    'short_code' => $playfield->short_code,
                    'name' => $playfield->name,
                    'created_at' => (string)$playfield->created_at
                ];
                break;

            case 'route':
                return [
                    'id' => $playfield->id,
                    'type' => $playfield_type,
                    'transit_id' => $playfield->transit_id,
                    'name' => $playfield->name,
                    'maps_url' => $playfield->maps_url,
                    'kilometers' => $playfield->kilometers,
                    'hours' => $playfield->hours,
                    'difficulty' => $playfield->difficulty,
                    'nature' => $playfield->nature,
                    'highway' => $playfield->highway,
                    'created_at' => (string)$playfield->created_at
                ];
                break;

            case 'transit':
                return [
                    'id' => $playfield->id,
                    'type' => $playfield_type,
                    'name' => $playfield->name,
                    'from' => $playfield->from,
                    'to' => $playfield->to,
                    'created_at' => (string)$playfield->created_at
                ];
                break;
        }
    }
}
