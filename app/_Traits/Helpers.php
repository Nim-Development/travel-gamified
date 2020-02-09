<?php

/**
 * In here we can declare insertion methods that help us insert specific nested arrays for the different
 * use cases per Resource.
 */

namespace App\_Traits;

use App\Route;
use App\User;
use App\Team;

trait Helpers
{
    public function attach_media($media_array)
    {
        foreach ($media_array as $collection_name => $media) {
            if($media){
                if(is_array($media)){
                    // loop over array of media items and add them using SPATIE one by one
                    foreach($media as $item){
                        $this->addMedia($item)->toMediaCollection($collection_name);
                    }
                }else{
                    // add single header
                    $this->addMedia($media)->toMediaCollection($collection_name);
                }
            }
        }
    }

    // takes array of ids
    public function attach_routes($route_id_array)
    {
        if($route_id_array){
            foreach ($route_id_array as $id) {
                $this->routes()->save(
                    Route::find($id)
                );
            }
        }
    }

    // takes array of ids
    public function attach_users($user_id_array)
    {
        if($user_id_array){
            foreach ($user_id_array as $id) {
                $this->users()->save(
                    User::find($id)
                );
            }
        }
    }

    // takes array of ids
    public function attach_teams($team_id_array)
    {
        if($team_id_array){
            foreach ($team_id_array as $id) {
                $this->teams()->save(
                    Team::find($id)
                );
            }
        }
    }
}