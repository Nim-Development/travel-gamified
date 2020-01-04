<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    // array of itineraries makes the complete travel schedule for this Tour in order.
    public function itinerary()
    {
        return $this->hasMany('App\Itinerary', 'tour_id', 'id')->orderBy('step');
    }

    public function trips()
    {
        return $this->hasMany('App\Trip', 'tour_id', 'id');
    }

    protected $fillable = ['name', 'duration'];
}
