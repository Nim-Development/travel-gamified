<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameMultipleChoiceOption extends Model
{
    protected $fillable = ['game_id', 'sort_order', 'text'];
}
