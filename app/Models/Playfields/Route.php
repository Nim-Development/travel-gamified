<?php

namespace App\Playfields;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    public function transit()
    {
        return $this->belongsTo('App\Playfields\Transit');
    }
    
    public function itinerary()
    {
        return $this->morphOne('App\Itinerary', 'playfield');
    }

    public function challenges()
    {
        return $this->morphMany('App\Games\Challenge', 'playfield');
    }
}
