<?php

namespace App;

use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use App\_Traits\MediaHelpers;

class AnswereChecked extends Model implements HasMedia
{
    use HasMediaTrait, MediaHelpers;

    public function challenge()
    {
        return $this->hasOne('App\Challenge', 'id', 'challenge_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('submission')
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

    protected $fillable = ['challenge_id', 'user_id', 'answere', 'score'];

}
