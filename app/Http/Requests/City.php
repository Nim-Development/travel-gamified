<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\_Traits\Helpers;

class City extends FormRequest
{
    use Helpers;
    
    protected $api_base = 'api/admin/cities';

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
                'short_code' => 'required|string',
                'name' => 'required|string'
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
        $rules = [
            'short_code' => 'string',
            'name' => 'string'
        ];
        $rules = $this->validate_media($rules);

        return $rules;
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
