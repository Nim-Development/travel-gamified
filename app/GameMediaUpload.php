<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameMediaUpload extends Model
{
    public function challenge()
    {
        return $this->belongsTo('App\Challenge', 'game_id', 'id');
    }
}
