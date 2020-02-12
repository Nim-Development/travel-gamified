<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{

    protected $fillable = ['tour_id', 'step', 'duration', 'playfield_type', 'playfield_id'];

    public function playfield()
    {
        return $this->morphTo('playfield');
    }

    public function tour()
    {
        return $this->belongsTo('App\Tour', 'tour_id', 'id');
    }

    public function createAndSortPeers() {
        $peers = $this->tour->itineraries; // all the relational itineraries sorted by step
        foreach ($peers as $peer) {
            // skip the itinerary that we have newly created
            if($peer->id != $this->id){
                // if the step is same or above the inserted step, then simply increment the step.
                if($peer->step == $this->step || $peer->step > $this->step){
                    $step_increment = $peer->step + 1;
                    $peer->update(['step' => $step_increment]);
                }
            }
        }

    }

}
