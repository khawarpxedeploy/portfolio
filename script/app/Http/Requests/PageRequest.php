<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'title'       => 'required|max:100',
            'excerpt'     => 'required|max:500',
            'description' => 'required',
            'status'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'       => 'title field is required',
            'title.max'            => 'title field max character is 100',
            'excerpt.required'     => 'short description field is required',
            'excerpt.max'          => 'short description field max character is 500',
            'description.required' => 'description field is required',
            'status.required'      => 'status field is required',
        ];
    }
}
