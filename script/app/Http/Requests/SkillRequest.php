<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
{
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
        return [
            "name"  => "required",
            "level" => "required",
            "color" => "required",
        ];
    }
    public function messages()
    {
        return [
            'name.required'  => ' Name field is required',
            'level.required' => ' Level field is required',
            'color.required' => ' Color field is required',
        ];
    }
}
