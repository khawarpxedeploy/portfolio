<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserBlogRequest extends FormRequest
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
            "name"        => "required",
            "image"       => "required|image|max:5120",
            "excerpt"     => "required",
            "description" => "required",
        ];
    }
    public function messages()
    {
        return [
            'name.required'        => 'name field is required',
            'image.required'       => 'image field is required',
            'image.max'            => 'image field max file size 5 mb',
            'excerpt.required'     => 'short description field is required',
            'description.required' => 'description field is required',
        ];
    }
}
