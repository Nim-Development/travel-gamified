<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Challenge extends FormRequest
{
    protected $api_base = 'api/admin/challenges';

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
                'sort_order' => 'integer',
                'playfield_type' => 'required|string',
                'playfield_id' => 'required|integer',
                'game_type' => 'required|string',
                'game_id' => 'required|integer'
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
                'playfield_type' => 'string',
                'playfield_id' => 'integer',
                'game_type' => 'string',
                'game_id' => 'integer'
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
