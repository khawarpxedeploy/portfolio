<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            "image"       => "required|image|max:5120",
            'link'        => 'required|max:100'
        ];
    }
    public function messages()
    {
        return [
            'title.required'       => 'Title field is required',
            'image.max'            => 'Image field max file size 5 mb',
            'image.image'          => 'Image field only take image file like (jpg,png,jpeg etc)',
            'link.required'        => 'Link field is required',
            'link.required'        => 'Link field need validate Url'
        ];
    }
}
