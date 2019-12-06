<?php

namespace App\Games;

use Illuminate\Database\Eloquent\Model;

class GameMultipleChoice extends Model
{
    public function challenge()
    {
        return $this->belongsTo('App\Games\Challenge', 'game_id', 'id');
    }

    public function options()
    {
        return $this->hasMany('App\Games\GameMultipleChoiceOption', 'game_id', 'id')->orderBy('sort_order');
    }

    protected $fillable = ['title', 'content_media', 'content_text', 'correct_answere', 'points_min', 'points_max'];
}
