<?php

namespace App\Modules\Morph;
use Illuminate\Support\Facades\Facade;

class PlayfieldsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'playfields';
    }
}

?>