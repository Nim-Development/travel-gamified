<?php

namespace App\Games;

use Illuminate\Database\Eloquent\Model;

class GameMediaUpload extends Model
{
    public function challenge()
    {
        return $this->belongsTo('App\Games\Challenge', 'game_id', 'id');
    }

    protected $fillable = ['title', 'content_media', 'content_text', 'media_type', 'correct_answere', 'points_min', 'points_max'];
}
