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
            'turbin_speed' => 'required|double',
            'rotor_vib_monitor' => 'required|double',
            'axial_displacement_monitor' => 'required|double',
            'main_steam' => 'required|double',
            'stage_steam' => 'required|double',
            'exhaust' => 'required|double',
            'lub_oil' => 'required|double',
            'control_oil' => 'required|double',
        ];
    }
}
