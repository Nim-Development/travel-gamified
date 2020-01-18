<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Challenge extends JsonResource
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
        $game = $this->game;

        return [
            'id' => $this->id,
            'sort_order' => (integer)$this->sort_order,
            'playfield' => (!$playfield) ? null : $this->insert_playfield($this->playfield_type, $playfield),
            'game' => (!$game) ? null : $this->insert_game($this->game_type, $game),
            'created_at' => (string)$this->created_at,
        ];
    }
}
