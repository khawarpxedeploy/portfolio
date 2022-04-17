<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminPaymentGatewayRequest extends FormRequest
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
            "name"           => ['required', Rule::unique('getways', 'name')->ignore($this->payment_gateway, 'id')],
            'rate'           => 'required',
            'currency_name'  => 'required',
            'charge'         => 'required',
            'status'         => 'required',
            'logo'           => 'nullable|image|max:5120',
        ];
    }
    public function messages()
    {
        return [
            'name.required'           => 'Name field is required',
            'rate.required'           => 'Rate field is required',
            'currency_name.required'  => 'Currency name field is required',
            'charge.required'         => 'Charge field is required',
            'status.required'         => 'Status field is required',
            'logo.image'              => 'Logo file must Be like image (png, jpg, jpeg etc)',
            'logo.max'                => 'Logo file max size is 5 MB',
        ];
    }
}
