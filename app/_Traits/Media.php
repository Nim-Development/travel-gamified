<?php

/**
 * In here we can declare insertion methods that help us insert specific nested arrays for the different
 * use cases per Resource.
 */

namespace App\_Traits;

trait MediaHelpers
{
    public function attachMedia(Array $media_array)
    {
        foreach ($media_array as $collection_name => $media) {
            if($media){
                if(is_array($media)){
                    $count = 0;
                    // loop over array of media items and add them using SPATIE one by one
                    foreach($media as $item){
                        $this->addMedia($item)->toMediaCollection($collection_name);
                    }
                    // return amount of added media items.
                    return $count;
                }else{
                    // add single header
                    $model->addMedia($item)->toMediaCollection($collection_name);
    
                    // return 1 that stands for 1 media item has been added to model
                    return 1;
                }
            }
            // no media has been added to model.
            return null;
        }
    }
}