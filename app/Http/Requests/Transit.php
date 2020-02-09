<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Transit extends FormRequest
{
    protected $api_base = 'api/admin/transits';

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
                'name' => 'required|string',
                'from_city_id' => 'required|integer',
                'from_city_id' => 'required|exists:cities,id',
                'to_city_id' => 'required|integer',
                'to_city_id' => 'required|exists:cities,id',

                'routes.*' => 'integer',
                'routes.*' => 'required|exists:routes,id'
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
                'name' => 'string',
                'from_city_id' => 'integer',
                'from_city_id' => 'exists:cities,id',
                'to_city_id' => 'integer',
                'to_city_id' => 'exists:cities,id',

                'routes.*' => 'integer',
                'routes.*' => 'exists:routes,id'
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
