<?php

namespace App;

use App\Events\UnlinkPoly;
use Illuminate\Database\Eloquent\Model;
use App\_Traits\Helpers;

class Transit extends Model
{
    use Helpers;
    
    public function routes()
    {
        return $this->hasMany('App\Route');
    }    
    
    public function itineraries()
    {
        return $this->morphMany('App\Itinerary', 'playfield');
    }

    public function challenges()
    {
        return $this->morphMany('App\Challenge', 'playfield');
    }

    // starting city
    public function from()
    {
        return $this->hasOne('App\City', 'id', 'from_city_id');
    }

    // ending city
    public function to()
    {
        return $this->hasOne('App\City', 'id', 'to_city_id');
    }

    protected $fillable = ['name', 'from_city_id', 'to_city_id'];

    // clean up relationships at deletion of this model. 
    public static function boot() {         
        parent::boot();         
        static::deleting(function($transit) { // before delete() method call this    

            // set foreign polymorphic data relational to this instance to NULL
            event(new UnlinkPoly($transit->itineraries, 'playfield_type', 'playfield_id'));
            event(new UnlinkPoly($transit->challenges, 'playfield_type', 'playfield_id'));
        }); 
    }
}
