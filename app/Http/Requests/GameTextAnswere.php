<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\_Traits\Helpers;

class GameTextAnswere extends FormRequest
{
    use Helpers;
    
    protected $api_base = 'api/admin/games/text_answere';

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
    public function post_rules()
    {
        /* store() */
        if($this->is($this->api_base)){
            $rules = [
                'title' => 'required|string',
                'content_text' => 'required|string',
                'correct_answere' => 'required|string',
                'points_min' => 'required|integer',
                'points_max' => 'required|integer'
            ];
            $rules = $this->validate_media($rules);
            return $rules;
        }


    }

    /////////
    // PUT //
    /////////
    public function put_rules()
    {
        if($this->is("$this->api_base/*")){
            $rules = [
                'title' => 'string',
                'content_text' => 'string',
                'correct_answere' => 'string',
                'points_min' => 'numeric',
                'points_max' => 'numeric'
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
