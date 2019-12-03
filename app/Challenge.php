<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    public function game()
    {
        // Here we return the game contents from one of the game type models based on type value in db
        return $this->hasOne(config('games.'.$this->type), 'id', 'game_id');
    }

    public function city()
    {
        return $this->belongsTo('App\City', 'id', 'city_id');
    }

    public function route()
    {
        return $this->belongsTo('App\Route', 'id', 'route_id');
    }
}