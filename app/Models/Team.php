<?php

namespace App;

use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Team extends Model implements HasMedia
{
    use HasMediaTrait;
    
    public function trip()
    {
        return $this->belongsTo('App\Trip', 'trip_id', 'id');
    }

    public function users()
    {
        return $this->hasMany('App\User', 'team_id', 'id');
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('badge')
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

    protected $fillable = ['trip_id', 'name', 'color', 'score'];
}
