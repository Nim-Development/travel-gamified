<?php

namespace App\Http\Requests\_Traits;

trait Helpers
{
    public function validate_media($rules)
    {
        if ($this->has('header')) {
            if(is_array($this->get('header'))){
                $rules['media.*'] = 'required|image';
            }else{
                $rules['media'] = 'required|image';
            }
        }

        if ($this->has('media')) {
            if(is_array($this->get('media'))){
                $rules['media.*'] = 'required|image';
            }else{
                $rules['media'] = 'required|image';
            }
        }

        if ($this->has('submission')) {
            if(is_array($this->get('submission'))){
                $rules['submission.*'] = 'required|image';
            }else{
                $rules['submission'] = 'required|image';
            }
        }

        if ($this->has('badge')) {
            if(is_array($this->get('badge'))){
                $rules['badge.*'] = 'required|image';
            }else{
                $rules['badge'] = 'required|image';
            }
        }

        return $rules;
    }
}