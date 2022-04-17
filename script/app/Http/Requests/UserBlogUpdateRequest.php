<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserBlogUpdateRequest extends FormRequest
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
            "image"       => "image|max:5120",
            "excerpt"     => "required",
            "description" => "required",
        ];
    }
    public function messages()
    {
        return [
            'name.required'        => 'Blog name field is required',
            'image.max'            => 'Blog image Field max file size 5 mb',
            'excerpt.required'     => 'Blog short description field is required',
            'description.required' => 'Blog description field is required',
        ];
    }
}
