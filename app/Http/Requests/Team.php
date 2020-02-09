<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\_Traits\Helpers;

class Team extends FormRequest
{
    use Helpers;
    
    protected $api_base = 'api/admin/teams';

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
        if($this->is($this->api_base)){
            $rules = [
                'trip_id' => 'integer',
                'name' => 'required|string',
                'color' => 'required|string',
                'score' => 'numeric',
    
                'users.*' => 'numeric',
                'trip_id' => 'exists:trips,id',
                'users.*' => 'exists:users,id'
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
                'trip_id' => 'integer',
                'name' => 'string',
                'color' => 'string',
                'score' => 'numeric',
    
                'users.*' => 'numeric',
                'trip_id' => 'exists:trips,id',
                'users.*' => 'exists:users,id'
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
