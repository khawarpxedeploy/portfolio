<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VCardRequest extends FormRequest
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
            'theme'         => 'required',
            'color'         => 'required',
            'slug'          => 'required|max:255',
            'name'          => 'required|max:255',
            'tagline'       => 'required|max:150',
            'description'   => 'required|max:300',
            "profile_image" => "image|max:5120",
            "cover_image"   => "image|max:5120",
        ];
    }
    public function messages()
    {
        return [
            'theme.required'         => 'Chose Card theme Layout field is required',
            'color.required'         => 'Card Color field is required',
            'slug.required'          => 'Contact description field is required',
            'slug.max'               => 'Contact description field max character 255',

            'name.required'          => 'name field is required',
            'name.max'               => 'name field max character 255',

            'tagline.required'       => 'Sub name field is required',
            'tagline.max'            => 'Sub name field max character 150',

            'description.required'   => 'Description field is required',
            'description.max'        => 'Description field max character 300',

            'profile_image.required' => 'Project Image field is required',
            'profile_image.max'      => 'Project Image field max file size 1mb',
            'profile_image.image'    => 'Project image file must be image(png, jpg, jpeg etc)',

            'favicon.required'       => 'Favicon field is required',
            'favicon.max'            => 'Favicon field max file size 5 mb',
            'favicon.image'          => 'Favicon file must be image(png, jpg, jpeg etc)',

            'cover_image.required'   => 'Cover Image field is required',
            'cover_image.max'        => 'Cover Image field max file size 1mb',
            'cover_image.mimes'      => 'Cover image file must be image(png, jpg, jpeg etc)',

        ];
    }
}
