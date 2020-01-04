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

    // starting city
    public function from()
    {
        return $this->hasOne('App\Playfields\City', 'id', 'from_city_id');
    }

    // ending city
    public function to()
    {
        return $this->hasOne('App\Playfields\City', 'id', 'to_city_id');
    }

    protected $fillable = ['name', 'from_city_id', 'to_city_id'];
}
