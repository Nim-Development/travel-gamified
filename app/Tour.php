<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    // array of itineraries makes the complete travel schedule for this Tour in order.
    public function itineraries()
    {
        return $this->hasMany('App\Itinerary', 'tour_id', 'id')->orderBy('step');
    }

    public function trips()
    {
        return $this->hasMany('App\Trip', 'tour_id', 'id');
    }


    // duration of all itineraries combined (in seconds)
    public function getDurationAttribute()
    {
        $duration = 0;
        foreach ($this->itineraries as $itinerary) {
            if(!is_null($itinerary->duration)){
                $duration = $duration + $itinerary->duration;
            }
        }
        if($duration < 60){
            return 0;
        }
        return $duration;
    }


    protected $fillable = ['name'];
}
