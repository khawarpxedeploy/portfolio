<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminOrderRequest extends FormRequest
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
            'email'        => 'required',
            'tenant'       => 'required',
            'getway_id'    => 'required',
            'trx'          => 'required|unique:orders',
            'plan_id'      => 'required',
            'email_status' => 'required',
            
        ];
    }
    public function messages()
    {
        return [
            'email.required'        => 'Email field is required',
            'tenant.required'       => 'User Name Is Required',
            'getway_id.required'    => 'Payment gateway field is required',
            'trx.required'          => 'Trx id field is required',
            'trx.unique'            => 'Trx id field need unique number',
            'plan_id.required'      => 'Plan field is required',
            'email_status.required' => 'Send email to customer? field is required',
            
        ];
    }
}
