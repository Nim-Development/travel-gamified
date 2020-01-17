<?php

namespace App\Listeners;

use App\Events\UnlinkPoly;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UnlinkPoly_Listener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UnlinkPoly  $event
     * @return void
     */
    public function handle(UnlinkPoly $event)
    {

        $relation = $event->relation;
        $foreign_type = $event->foreign_type;
        $foreign_key = $event->foreign_key;

        
        
        if(!$relation){
            
            return null;
        }else{
            // check if relations is a collection
            if($relation instanceof \Illuminate\Database\Eloquent\Collection){
                if(!$relation->isEmpty()){
                    foreach($relation as $model){
            
                        // set ftype and key in foreign table to NULL
                        $model->$foreign_type = NULL;
                        $model->$foreign_key = NULL;
                        $model->save();
                    }
                }
            }else{
                // set ftype and key in foreign table to NULL
                $relation->$foreign_type = NULL;
                $relation->$foreign_key = NULL;

                $relation->save();
            }
        }
    }
}
