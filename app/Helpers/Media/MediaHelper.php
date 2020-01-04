<?php

namespace App\Helpers\Media;

class MediaHelper
{
    // can take a single media item or an array and processes it using SPATIE media-library accordingly
    // returns either the number of inserted media items or null (if there is no media)
    public function model_insert($model, $media, $collection_name)
    {
        if($media){
            if(is_array($media)){
                $count = 0;
                // loop over array of media items and add them using SPATIE one by one
                foreach($media as $item){
                    $model->addMedia($item)->toMediaCollection($collection_name);
                    $count++;
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
