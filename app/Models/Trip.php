<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
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
}
