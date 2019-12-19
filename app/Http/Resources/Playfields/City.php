<?php

namespace App\Http\Resources\Playfields;

use Illuminate\Http\Resources\Json\JsonResource;

class City extends JsonResource
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
            'short_code' => $this->short_code,
            'name' => $this->name,
            'created_at' => (string)$this->created_at
        ];
    }
}
