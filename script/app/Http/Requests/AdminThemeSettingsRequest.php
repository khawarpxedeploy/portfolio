<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminThemeSettingsRequest extends FormRequest
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
            "favicon"                 => "mimes:ico|max:5120",
            "logo"                    => "mimes:png|max:5120",
            "header_image"            => "mimes:png|max:5120",
            "email"                   => "required",
          
        
        ];
    }
    public function messages()
    {
        return [
            'logo.required'                    => ' Logo field is required',
            'logo.max'                         => ' Logo file max size is 5 mb',
            'logo.mimes'                       => ' Logo file support only svg file',

            'favicon.required'                 => ' Favicon field is required',
            'favicon.max'                      => ' Favicon file max size is 5 mb',
            'favicon.mimes'                    => ' Logo file support only ico File',

            'email.required'                   => 'Email field is required',
            'phone.required'                   => 'Phone field is required',
           

          

        ];
    }
}
