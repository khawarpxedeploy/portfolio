<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
            "name"                => 'required',
            "duration"            => 'required',
            "price"               => 'required|numeric',
            "storage_size"        => 'required',
            "postlimit"           => 'required',
            "portfolio_builder"   => 'required',
            "custom_domain"       => 'required',
            "sub_domain"          => 'required',
            
           
            "online_cv"           => 'required',
            "vcard"               => 'required',
            "qrcode"              => 'required',
            "resume_builder"      => 'required',
           
            "status"              => 'required',
          
        ];
    }
    public function messages()
    {
        return [
            'name.required'                => 'Name field is required',
            'duration.required'            => 'Duration field is required',
            'price.required'               => 'Price field is required',
            'storage_size.required'        => 'Storage size field is required',
            'postlimit.required'           => 'Post limit field is required',
            'portfolio_builder.required'   => 'Portfolio builder field is required',
            'custom_domain.required'       => 'Custom domain  field is required',
            'sub_domain.required'          => 'Sub domain field is required',
            'analytics.required'           => 'Analytics field is required',
            'online_businesscard.required' => 'Online business card  field is required',
            'qrcode.required'              => 'QR Code field is required',
            'resume_builder.required'      => 'Resume builder field is required',
            'is_featured.required'         => 'Is featured field is required',
            'status.required'              => 'Status field is required',
            'is_trial.required'            => 'Is trial field is required',
            'is_default.required'          => 'Is default field is required',
            'vcard.required'               => 'Vcard field is required',
            'online_cv.required'           => 'Online CV field is required'
        ];
    }
}
