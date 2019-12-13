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

    protected $fillable = ['sort_order'];
}
