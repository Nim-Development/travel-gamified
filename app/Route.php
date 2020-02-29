<?php

namespace App;

use App\Events\UnlinkPoly;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    public function transit()
    {
        return $this->belongsTo('App\Transit');
    }
    
    public function itineraries()
    {
        return $this->morphMany('App\Itinerary', 'playfield');
    }

    public function challenges()
    {
        return $this->morphMany('App\Challenge', 'playfield');
    }

    protected $fillable = [ 'transit_id', 'name', 'maps_url', 'polyline', 'kilometers', 'duration', 'difficulty', 'nature', 'highway'];
    

    // clean up relationships at deletion of this model. 
    public static function boot() {         
        parent::boot();         
        static::deleting(function($route) { // before delete() method call this    

            // set foreign polymorphic data relational to this instance to NULL
            event(new UnlinkPoly($route->itineraries, 'playfield_type', 'playfield_id'));
            event(new UnlinkPoly($route->challenges, 'playfield_type', 'playfield_id'));
        }); 
    }

}
