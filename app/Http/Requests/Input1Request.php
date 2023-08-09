<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class Input1Request extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        if ($this->method() == Request::METHOD_POST) {
            return true;
        }
        $input1 = $this->route('input1');
        return auth()->user()->id == $input1->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'inlet_steam' => 'required|double',
            'exm_steam' => 'required|double',
            'turbin_thrust_bearing' => 'required|double',
            'tb_gov_side' => 'required|double',
            'tb_coup_side' => 'required|double',
            'pb_tbn_side' => 'required|double',
            'pb_gen_side' => 'required|double',
            'wb_tbn_side' => 'required|double',
            'wb_gen_side' => 'required|double',
            'oc_lub_oil_outlet' => 'required|double',
        ];
    }
}
