<?php

namespace App\Helpers\Config;

use App\Games\Challenge;

class ConfigHelper
{

 public function validate_keyname($config_array, $check_value)
 {
    // validate if (string)$check_value is present as a key inside the (string)$config_path
    /** Mainly used to check if a api gives $type in config('models..') actually exists. */
    $res = false;
    foreach($config_array as $key => $value){
        if($key == $check_value){
            $res = true;
        }
    }
    return $res;
 }

}
