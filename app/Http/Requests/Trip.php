<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Trip extends FormRequest
{
    protected $api_base = 'api/admin/trips';

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
                'tour_id' => 'required|integer',
                'name' => 'required|string',
                'timezone' => 'required|string',
                'start_date_time' => 'required|date',
                'teams.*' => 'numeric',
                'teams.*' => 'exists:teams,id',
                'tour_id' => 'exists:tours,id'
            ];

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
                'tour_id' => 'integer',
                'name' => 'string',
                'timezone' => 'string',
                'start_date_time' => 'date',
                'teams.*' => 'numeric',
                'teams.*' => 'exists:teams,id',
                'tour_id' => 'exists:tours,id'
            ];

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
