<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminTenantUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "duration"            => 'required',
            "storage_size"        => 'nullable',
            "resume_builder"      => 'required',
            "postlimit"           => 'required',
            "portfolio_builder"   => 'required',
            "custom_domain"       => 'required',
            "sub_domain"          => 'required',
            "analytics"           => 'required',
            "online_businesscard" => 'required',
            "qrcode"              => 'required',
        ];
    }
    public function messages()
    {
        return [
            'duration.required'            => 'Duration field is required',
            'resume_builder.required'      => 'Resume builder field is required',
            'postlimit.required'           => 'Post limit field is required',
            'portfolio_builder.required'   => 'Portfolio builder field is required',
            'custom_domain.required'       => 'Custom domain field is required',
            'sub_domain.required'          => 'Sub domain field is required',
            'analytics.required'           => 'Analytics field is required',
            'online_businesscard.required' => 'Online business card field is required',
            'qrcode.required'              => 'QR Code field is required',
        ];
    }
}
