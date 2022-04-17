<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteSettingsRequest extends FormRequest
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
            "favicon" => "mimes:ico|max:5000",
            "css"    => "max:1000",
            "js"    => "max:1000",

            "logo"    => "nullable|mimes:png|max:200",
            "hero_img"    => "nullable|image|max:1000",
            "about_img"    => "nullable|image|max:1000",
            "service_title" => "nullable|max:40",
            "service_description" => "nullable|max:200",
            "portoflio_title" => "nullable|max:40",
            "portoflio_description" => "nullable|max:200",
            "blog_title" => "nullable|max:40",
            "blog_description" => "nullable|max:200",
            "contact_title" => "nullable|max:40",
            "testimonial_description" => "nullable|max:200",
            "contact_short_description" => "nullable|max:200",
            "contact_address" => "nullable|max:200",
            "contact_email" => "nullable|max:40",
            "contact_phone" => "nullable|max:20",

        ];
    }
    public function messages()
    {
        return [
           
            'favicon.image'   => 'Favicon file must be .ico format',
            'logo.mimes'      => 'Logo file must be png file',
            

        ];
    }
}
