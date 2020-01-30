<?php

namespace App;

use App\Events\UnlinkPoly;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use App\_Traits\MediaHelpers;

class GameMultipleChoice extends Model implements HasMedia
{
    use HasMediaTrait, MediaHelpers;

    public function challenge()
    {
        return $this->morphOne('App\Challenge', 'game');
    }

    public function options()
    {
        return $this->hasMany('App\GameMultipleChoiceOption', 'game_id', 'id')->orderBy('sort_order');
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

    protected $fillable = ['title', 'content_text', 'correct_answere', 'points_min', 'points_max'];
    
    // clean up relationships at deletion of this model. 
    public static function boot() {         
        parent::boot();         
        static::deleting(function($game) { // before delete() method call this    
            // set foreign polymorphic data relational to this instance to NULL
            event(new UnlinkPoly($game->challenge, 'game_type', 'game_id'));
        }); 
    }
}
