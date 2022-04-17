<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutMeRequest extends FormRequest
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
            'description' => 'required',
            'cv'          => 'mimes:pdf,odt,docx|max:5120',
            'image'       => 'image|max:1000',
        ];
    }
    public function messages()
    {
        return [
            'cv.required' => 'CV field is required',
            'cv.max'      => 'CV file field max file size 10 MB ',
            'cv.mimes'    => 'CV file field  accept PDF,ODT,DOCX type file',
            'image.max'   => 'Image file field max file size 5 MB',
            'image.image' => 'Image file accept png,jpg,jpeg etc file',
        ];
    }
}
