<?php

namespace App\Playfields;

use Illuminate\Database\Eloquent\Model;

class Transit extends Model
{

    public function routes()
    {
        return $this->hasMany('App\Playfields\Route');
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
