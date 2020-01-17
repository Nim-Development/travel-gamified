<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    public function playfield()
    {
        return $this->morphTo('playfield');
    }

    public function tour()
    {
        return $this->belongsTo('App\Tour', 'tour_id', 'id');
    }


    protected $fillable = ['tour_id', 'step', 'duration', 'playfield_type', 'playfield_id'];

    

}
