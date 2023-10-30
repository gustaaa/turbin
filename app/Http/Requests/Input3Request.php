<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class Input3Request extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        if ($this->method() == Request::METHOD_POST) {
            return true;
        }
        $input3 = $this->route('input3');
        return auth()->user()->id == $input3->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'temp_water_in' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'temp_water_out' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'temp_oil_in' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'temp_oil_out' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'vacum' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'injector' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'speed_drop' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'load_limit' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'flo_in' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'flo_out' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }
}
