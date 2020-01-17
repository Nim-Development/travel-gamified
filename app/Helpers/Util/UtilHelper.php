<?php

namespace App\Helpers\Util;

class UtilHelper
{
    public function unlink_relations($relations, $foreign_key)
    {
        if(!$relations){
            return null;
        }
        if(is_array($relations)){
            foreach($relations as $model){
                $model->$foreign_key = NULL;
                $model->save();
            }
        }else{
            $relations->$foreign_key = NULL;
            $model->save();
        }
    }

    public function unlink_poly($relations, $foreign_key, $foreign_type)
    {
        if(!$relations){
            return null;
        }
        if(is_array($relations)){
            foreach($relations as $model){
                $model->$foreign_key = NULL;
                $model->$foreign_type = NULL;
                $model->save();
            }
        }else{
            $relations->$foreign_key = NULL;
            $relations->$foreign_type = NULL;
            $model->save();
        }

    }
}
