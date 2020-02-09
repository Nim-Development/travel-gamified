<?php

namespace App;

use App\Events\UnlinkRelations;
use Illuminate\Database\Eloquent\Model;
use App\_Traits\Helpers;

class Trip extends Model
{
    use Helpers;

    public function tour()
    {
        return $this->belongsTo('App\Tour', 'tour_id', 'id');
    }

    public function teams()
    {
        return $this->hasMany('App\Team', 'trip_id', 'id');
    }

    public function users()
    {
        return $this->hasMany('App\User', 'trip_id', 'id');
    }

    protected $fillable = ['tour_id', 'name', 'timezone', 'start_date_time'];

}