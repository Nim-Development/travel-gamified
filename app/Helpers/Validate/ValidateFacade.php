<?php

namespace App\Helpers\Validate;

use Illuminate\Support\Facades\Facade;

class ValidateFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'validatehelper';
    }
}