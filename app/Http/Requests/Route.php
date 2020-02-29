<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Route extends FormRequest
{
    protected $api_base = 'api/admin/routes';

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
                'transit_id' => 'required|numeric',
                'transit_id' => 'required|exists:transits,id',
                'name' => 'required|string',
                'maps_url' => 'required|string',
                'polyline' => 'string',
                'kilometers' => 'required|numeric',
                'duration' => 'required|numeric',
                'difficulty' => 'required|numeric',
                'nature' => 'required|numeric',
                'highway' => 'required|numeric'
            ];
        }
    }

    /////////
    // PUT //
    /////////
    public function put_rules()
    {
        if($this->is("$this->api_base/*")){
            $rules = [
                'transit_id' => 'numeric',
                'name' => 'string',
                'maps_url' => 'string',
                'polyline' => 'string',
                'kilometers' => 'numeric',
                'duration' => 'numeric',
                'difficulty' => 'numeric',
                'nature' => 'numeric',
                'highway' => 'integer'
            ];

            if($this->has('transit_id')){
                $rules['transit_id'] = 'exists:transits,id';
            }

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
