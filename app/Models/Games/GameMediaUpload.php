<?php

namespace App\Games;

use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class GameMediaUpload extends Model implements HasMedia
{
    use HasMediaTrait;

    public function challenge()
    {
        return $this->morphOne('App\Games\Challenge', 'game');
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

    protected $fillable = ['title', 'content_text', 'media_type', 'correct_answere', 'points_min', 'points_max'];
}
