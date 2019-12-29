<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    
    public function trip()
    {
        return $this->belongsTo('App\Trip', 'trip_id', 'id');
    }

    public function users()
    {
        return $this->hasMany('App\User', 'team_id', 'id');
    }

}
