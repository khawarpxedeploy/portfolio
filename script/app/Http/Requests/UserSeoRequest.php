<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSeoRequest extends FormRequest
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
            'seo_home.site_name'          => 'required',
            'seo_home.metatag'            => 'required',
            'seo_home.twitter_site_title' => 'required',
            'seo_home.metadescription'    => 'required',
            'seo_blog.site_name'          => 'required',
            'seo_blog.metatag'            => 'required',
            'seo_blog.twitter_site_title' => 'required',
            'seo_blog.metadescription'    => 'required',
        ];
    }
    public function messages()
    {
        return [
            'seo_home.site_name.required'          => 'The Seo Home Site Name field is required.',
            'seo_home.metatag.required'            => 'The Seo Home Meta Tag field is required.',
            'seo_home.twitter_site_title.required' => 'The Seo Home Twitter Site title field is required.',
            'seo_home.metadescription.required'    => 'The Seo Home Meta Description field is required.',

            'seo_blog.site_name.required'          => 'The Seo Blog Site Name field is required.',
            'seo_blog.metatag.required'            => 'The Seo Blog Meta Tag field is required.',
            'seo_blog.twitter_site_title.required' => 'The Seo Blog Twitter Site title field is required.',
            'seo_blog.metadescription.required'    => 'The Seo Blog Meta Description field is required.',
        ];
    }
}
