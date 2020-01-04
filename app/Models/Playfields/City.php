<?php

namespace App\Playfields;

use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class City extends Model implements HasMedia
{
    use HasMediaTrait;
    
    public function itinerary()
    {
        return $this->morphOne('App\Itinerary', 'playfield');
    }

    public function challenges()
    {
        return $this->morphMany('App\Games\Challenge', 'playfield');
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

}
