<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameMultipleChoice extends Model
{
    public function challenge()
    {
        return $this->belongsTo('App\Challenge', 'game_id', 'id');
    }

    public function options()
    {
        return $this->hasMany('App\GameMultipleChoiceOption', 'game_id', 'id')->orderBy('sort_order');
    }
}
