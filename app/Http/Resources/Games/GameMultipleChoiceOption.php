<?php

namespace App\Http\Resources\Games;

use Illuminate\Http\Resources\Json\JsonResource;

class GameMultipleChoiceOption extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'game_id' => $this->game_id,
            'sort_order' => $this->sort_order,
            'text' => $this->text,
            'created_at' => (string)$this->created_at
        ];
    }
}
