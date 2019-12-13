<?php

namespace App\Games;

use Illuminate\Database\Eloquent\Model;

class GameMediaUpload extends Model
{
    public function challenge()
    {
        return $this->morphOne('App\Games\Challenge', 'game');
    }

    protected $fillable = ['title', 'content_media', 'content_text', 'media_type', 'correct_answere', 'points_min', 'points_max'];
}
