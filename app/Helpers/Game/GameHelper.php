<?php

namespace App\Helpers\Game;

use App\Challenge;
use App\GameMediaUpload;
use App\GameMultipleChoice;
use App\GameTextAnswere;

class GameHelper
{
    // this class helps in easily constructing a game object
    public $challenge;

    // add a new challenge / game
    public function initchallenge($type, $id, $position = null){
        // - $type (city or route)
        // - $id (city_id or route_id)
        // - $position (where to position challenge in sort order) // figure out laterr
        $this->challenge = new Challenge();
        
        $this->challenge->sort_order = 0;
        $this->challenge->city_id = $type == 'city' ? $id : null;
        $this->challenge->route_id = $type == 'route' ? null : $id;
    }

    public function addGame($type, ){
        // - $type specified by eloquent Model Name!
        
    }

    public function saySomething()
    {
        dd('I said something');
    }

    public function reorder()
    {

    }


}