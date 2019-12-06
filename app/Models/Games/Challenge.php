<?php

namespace App\Games;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    public function game()
    {
        // Here we return the game contents from one of the game type models based on type value in db
        return $this->hasOne(config('models.games.'.$this->game_type), 'id', 'game_id');
    }

    public function playfield()
    {
        return $this->hasOne(config('models.playfields.'.$this->playfield_type), 'id', 'playfield_id');
    }

    protected $fillable = ['sort_order'];
}
