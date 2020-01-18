<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\GameMultipleChoiceOption;

class GameMultipleChoice extends JsonResource
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
        $options = $this->options;

        return [
            'id' => $this->id,
            'title' => $this->title,
            'content_text' => $this->content_text,
            'correct_answere' => $this->correct_answere,
            'points_min' => (integer)$this->points_min,
            'points_max' => (integer)$this->points_max,
            'options' => (!$options) ? null : $this->insert_options($this->options),
            'header' => $this->insert_media_conversions($this->getMedia('header')),
            'media_content' => $this->insert_media_conversions($this->getMedia('media')),
            'created_at' => (string)$this->created_at
        ];
    }

    /////////////
    // PRIVATE //
    /////////////

}
