<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswereChecked extends Model
{
    public function challenge()
    {
        return $this->hasOne('App\Challenge', 'id', 'challenge_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
