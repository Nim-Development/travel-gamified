<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Itinerary extends FormRequest
{
    protected $api_base = 'api/admin/itineraries';

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
                'tour_id' => 'integer',
                'step' => 'required|integer',
                'days' => 'numeric',
                'hours' => 'numeric',
                'minutes' => 'numeric',
                'playfield_type' => 'string',
                'playfield_id' => 'integer'
            ];
        }
        if($this->is("$this->api_base/sort")){
            return [
                'sort_order' => 'array'
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
                'tour_id' => 'integer',
                'step' => 'integer',
                'days' => 'numeric',
                'hours' => 'numeric',
                'minutes' => 'numeric',
                'playfield_type' => 'string',
                'playfield_id' => 'integer',
                'tour_id' => 'exists:tours,id'
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
