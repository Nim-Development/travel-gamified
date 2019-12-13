<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    public function playfield()
    {
        return $this->morphTo('playfield');
    }
}
