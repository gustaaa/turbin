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
            'temp_water_in' => 'required|double',
            'temp_water_out' => 'required|double',
            'temp_oil_in' => 'required|double',
            'temp_oil_out' => 'required|double',
            'vacum' => 'required|double',
            'injector' => 'required|double',
            'speed_drop' => 'required|double',
            'load_limit' => 'required|double',
            'flo_in' => 'required|double',
            'flo_out' => 'required|double',
        ];
    }
}
