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
            'inlet_steam' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'exm_steam' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'turbin_thrust_bearing' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'tb_gov_side' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'tb_coup_side' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'pb_tbn_side' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'pb_gen_side' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'wb_tbn_side' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'wb_gen_side' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'oc_lub_oil_outlet' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }
}
