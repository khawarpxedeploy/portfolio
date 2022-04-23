<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
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
            "name"        => "required|max:255",
            "image"       => "nullable|image|max:5120",
            "excerpt"     => "required",
            "description" => "required",
            "status"      => "required",
        ];
    }
    public function messages()
    {
        return [
            'name.required'        => 'Blog name field is required',
            'name.max'             => 'Blog name field max character 255',
            'image.max'            => 'Blog image field max file size 5 mb',
            'status.required'      => 'Status field is required',
            'excerpt.required'     => 'Blog short description field is required',
            'description.required' => 'Blog description field is required',
        ];
    }
}
