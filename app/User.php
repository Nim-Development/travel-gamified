<?php

namespace App;

use Spatie\MediaLibrary\Models\Media;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\_Traits\MediaHelpers;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasMediaTrait, MediaHelpers, HasApiTokens;

    public function team()
    {
        return $this->belongsTo('App\Team', 'team_id', 'id');

    }

    public function trip()
    {
        return $this->belongsTo('App\Trip', 'trip_id', 'id');
    }


    // to get access to model props inside registerMediaConversions()
    public $registerMediaConversionsUsingModelInstance = true;

    // In this method you can save the media as a collection of different sizes, etc. (same pic in different versions)
    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatar')
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

    public function isAdmin()
    {
        return $this->is_admin;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'family_name', 
        'age',
        'gender',
        'email',
        'phone',
        'password', 
        'is_admin',
        'score'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
