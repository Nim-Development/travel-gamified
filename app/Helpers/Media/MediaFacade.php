<?php

namespace App\Helpers\Media;

use Illuminate\Support\Facades\Facade;

class MediaFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'mediahelper';
    }
}