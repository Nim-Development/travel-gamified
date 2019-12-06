<?php

namespace App\Helpers\Config;

use Illuminate\Support\Facades\Facade;

class ConfigFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'confighelper';
    }
}
