<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class City extends JsonResource
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
        return [
            'id' => $this->id,
            'short_code' => $this->short_code,
            'name' => $this->name,
            'header' => $this->insert_media_conversions($this->getMedia('header')),
            'media' => $this->insert_media_conversions($this->getMedia('media')),
            'created_at' => (string)$this->created_at
        ];
    }
}
