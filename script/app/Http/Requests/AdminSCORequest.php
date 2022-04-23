<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminSCORequest extends FormRequest
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
            'site_name'          => 'required',
            'matatag'            => 'required',
            'twitter_site_title' => 'required',
            'matadescription'    => 'required',
        ];
    }
    public function messages()
    {
        return [
            'site_name.required'          => 'Site Name field is required',
            'matatag.required'            => 'Meta Tag Name field is required',
            'twitter_site_title.required' => 'Twitter Site Title field is required',
            'matadescription.required'    => 'Meta Description field is required',

        ];
    }
}
