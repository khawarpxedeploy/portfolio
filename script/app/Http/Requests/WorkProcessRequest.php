<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkProcessRequest extends FormRequest
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
            "title" => "required|max:50",
            "icon"  => "required",
            "des"   => "required|max:300",
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Title field is required',
            'title.max'      => 'Title field max character 50',
            'des.max'        => 'Description field max character 50',
            'icon.required'  => 'Icon field is required',
            'des.required'   => 'Description field is required',
        ];
    }
}
