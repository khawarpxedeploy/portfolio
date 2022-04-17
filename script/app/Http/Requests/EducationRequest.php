<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
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
            'starting_date' => 'required|max:10',
            'ending_date'   => 'max:10',
            'subject'       => 'required|max:50',
            'university'    => 'required|max:100',
            'short_content' => 'required|max:200'
        ];
    }
    public function messages()
    {
        return [
            'starting_date.required' => 'Starting Date field is required',
            'ending_date.required'   => 'Ending Date field is required',
            'subject.required'       => 'Subject field is required',
            'university.required'    => 'School / University field is required',
            'short_content.required'    => 'Short Content field is required',
        ];
    }
}
