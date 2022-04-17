<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            "image"       => "required|image|max:5120",
            "excerpt"     => "required",
            "description" => "required",
            "status"      => "required",
        ];
    }
    public function messages()
    {
        return [
            'name.required'        => 'Blog name field is required',
            'name.max'             => 'Blog name field Max character 255',
            'image.required'       => 'Blog image field is required',
            'image.max'            => 'Blog image field max file size 5 mb',
            'image.image'          => 'Blog image file must be image(png, jpg, jpeg etc)',
            'status.required'      => 'Status field is required',
            'excerpt.required'     => 'Blog short description field is required',
            'description.required' => 'Blog description field is required',
        ];
    }
}
