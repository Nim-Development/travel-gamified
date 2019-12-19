<?php

namespace App\Http\Resources\Games;

use Illuminate\Http\Resources\Json\JsonResource;

class GameMediaUpload extends JsonResource
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
            'media_type' => $this->media_type,
            'correct_answere' => $this->correct_answere,
            'points_min' => (integer)$this->points_min,
            'points_max' => (integer)$this->points_max,
            'created_at' => (string)$this->created_at
        ];
    }
}
