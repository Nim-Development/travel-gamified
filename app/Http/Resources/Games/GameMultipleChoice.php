<?php

namespace App\Http\Resources\Games;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Games\GameMultipleChoiceOption;

class GameMultipleChoice extends JsonResource
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
            'title' => $this->title,
            'content_media' => $this->content_media,
            'content_text' => $this->content_text,
            'correct_answere' => $this->correct_answere,
            'points_min' => (integer)$this->points_min,
            'points_max' => (integer)$this->points_max,
            'options' => $this->insert_options($this->options),
            'created_at' => (string)$this->created_at
        ];
    }

    /////////////
    // PRIVATE //
    /////////////

    // function to loop trough options relation and return it as 2d array for insert.
    private function insert_options($opts)
    {
        $options_array = [];
        foreach ($opts as $option) {
            array_push($options_array,
                [
                    'id' => $option->id,
                    'sort_order' => $option->sort_order,
                    'text' => $option->text,
                    'created_at' => (string)$option->created_at
                ]
            );
        }
        return $options_array;
    }
}
