<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    public function playfield()
    {
        return $this->hasOne(config('models.playfields.'.$this->playfield_type), 'id', 'playfield_id');
    }
}
