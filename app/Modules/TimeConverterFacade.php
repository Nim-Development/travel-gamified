<?php

namespace App\Modules\Time;
use Illuminate\Support\Facades\Facade;

class TimeConverterFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'converter';
    }
}

?>