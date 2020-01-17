<?php

namespace App\Helpers\Util;

use Illuminate\Support\Facades\Facade;

class UtilFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'utilhelper';
    }
}