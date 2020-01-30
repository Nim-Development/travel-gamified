<?php

namespace App;

use App\Events\UnlinkPoly;
use App\Transit;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use App\_Traits\MediaHelpers;

class City extends Model implements HasMedia
{
    use HasMediaTrait, MediaHelpers;
    
    public function itineraries()
    {
        return $this->morphMany('App\Itinerary', 'playfield');
    }

    public function challenges()
    {
        return $this->morphMany('App\Challenge', 'playfield');
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('header')
        ->registerMediaConversions(function(Media $media){
           $this->addMediaConversion('thumb')
               ->width(100) //??
               ->height(100); //??
            $this->addMediaConversion('md')
               ->width(368) //??
               ->height(232); //??
           $this->addMediaConversion('sm')
               ->width(368) //??
               ->height(232); //??
       });

        $this->addMediaCollection('media')
        ->registerMediaConversions(function(Media $media){
           $this->addMediaConversion('thumb')
               ->width(100) //??
               ->height(100); //??
            $this->addMediaConversion('md')
               ->width(368) //??
               ->height(232); //??
           $this->addMediaConversion('sm')
               ->width(368) //??
               ->height(232); //??
       });
    }

    protected $fillable = ['short_code', 'name'];


    // clean up relationships at deletion of this model. 
    public static function boot() {         
        parent::boot();         
        static::deleting(function($city) { // before delete() method call this    

            // set foreign polymorphic data relational to this instance to NULL
            event(new UnlinkPoly($city->itineraries, 'playfield_type', 'playfield_id'));
            event(new UnlinkPoly($city->challenges, 'playfield_type', 'playfield_id'));
        }); 
    }

}

