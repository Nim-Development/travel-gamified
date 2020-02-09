<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\_Traits\Helpers;

class Answere extends FormRequest
{
    use Helpers;
    
    protected $api_base = 'api/admin/answeres';

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
        if($this->is("$this->api_base/checked")){
            $rules = [
                'challenge_id' => 'required|integer',
                'challenge_id' => 'required|exists:challenges,id',
                'user_id' => 'required|integer',
                'user_id' => 'required|exists:users,id',
                'answere' => 'required|string',
                'score' => 'integer|nullable'
            ];
            $rules = $this->validate_media($rules);
            return $rules;
        }

        if($this->is("$this->api_base/unchecked")){
            $rules = [
                'challenge_id' => 'required|integer',
                'challenge_id' => 'required|exists:challenges,id',
                'user_id' => 'required|integer',
                'user_id' => 'required|exists:users,id',
                'answere' => 'required|string',
                'score' => 'integer|nullable'
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
        if($this->is("$this->api_base/checked/*")){
            $rules = [
                'challenge_id' => 'integer',
                'challenge_id' => 'exists:challenges,id',
                'user_id' => 'integer',
                'user_id' => 'exists:users,id',
                'answere' => 'string',
                'score' => 'nullable'
            ];
            $rules = $this->validate_media($rules);
            return $rules;
        }

        if($this->is("$this->api_base/unchecked/*")){
            $rules = [
                'challenge_id' => 'integer',
                'challenge_id' => 'exists:challenges,id',
                'user_id' => 'integer',
                'user_id' => 'exists:users,id',
                'answere' => 'string',
                'score' => 'nullable'
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
