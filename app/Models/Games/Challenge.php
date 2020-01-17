<?php

namespace App\Games;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    public function playfield()
    {
        return $this->morphTo('playfield');
    }

    public function game()
    {
        return $this->morphTo('game');
    }

    public function answeres_checked()
    {
        return $this->hasMany('App\AnsweresChecked');
    }

    public function answeres_unchecked()
    {
        return $this->hasMany('App\AnsweresUnchecked');
    }

    protected $fillable = ['sort_order','playfield_type','playfield_id','game_type','game_id'];

}
