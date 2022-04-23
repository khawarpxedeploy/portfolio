<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
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
            "position"       => "required|max:30",
            "icon"        => "required|max:30",
            "start_date"  => "required|max:10",
            "end_date"    => "nullable|max:10",
            "description" => "required|max:100",

        ];
    }
    public function messages()
    {
        return [
            'position.required'       => 'Position field is required',
            'icon.required'        => 'Icon field is required',
            'description.required' => 'Short Description field is required',
            'start_date.required'  => 'Start Date field is required',

        ];
    }
}
