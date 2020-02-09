<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\_Traits\Helpers;

class GameMediaUpload extends FormRequest
{

    use Helpers;
    
    protected $api_base = 'api/admin/games/media_upload';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->isMethod('post')){
            return $this->post_rules();
        }
        if($this->isMethod('put')){
            return $this->put_rules();
        }
    }

    //////////
    // POST //
    //////////
    
    /* store() */
    public function post_rules()
    {
        if($this->is($this->api_base)){
            $rules = [
                'title' => 'required|string',
                'content_text' => 'required|string',
                'correct_answere' => 'required|string',
                'media_type' => 'required|string',
                'points_min' => 'required|integer',
                'points_max' => 'required|integer',
                'header.*' => 'image',
                'media.*' => 'image'
            ];
            $rules = $this->validate_media($rules);
            return $rules;
        }
    }

    /////////
    // PUT //
    /////////

    /* update() */
    public function put_rules()
    {
        if($this->is("$this->api_base/*")){
            $rules = [
                'title' => 'string',
                'content_text' => 'string',
                'correct_answere' => 'string',
                'media_type' => 'string',
                'points_min' => 'numeric',
                'points_max' => 'numeric',
                'header.*' => 'image',
                'media.*' => 'image'
            ];
            $rules = $this->validate_media($rules);
            return $rules;
        }
    }


    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
        ];
    }
}
