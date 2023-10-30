<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class Input2Request extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        if ($this->method() == Request::METHOD_POST) {
            return true;
        }
        $Input2 = $this->route('input2');
        return auth()->user()->id == $Input2->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'turbin_speed' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'rotor_vib_monitor' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'axial_displacement_monitor' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'main_steam' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'stage_steam' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'exhaust' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'lub_oil' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'control_oil' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }
}
