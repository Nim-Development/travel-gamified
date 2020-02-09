<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordReset extends FormRequest
{
    protected $api_base = 'api/password/reset';

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
            return [
                'email' => 'required|string|email',
                'password' => 'required|string',
                'token' => 'required|string'
            ];
        }

        if($this->is("$this->api_base/request/token")){
            return [
                'email' => 'required|string|email'
            ];
        }
    }

    /////////
    // PUT //
    /////////
    public function put_rules()
    {
        if($this->is("$this->api_base/*")){
            return [

            ];
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
