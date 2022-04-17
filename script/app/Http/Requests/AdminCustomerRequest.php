<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCustomerRequest extends FormRequest
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
            'name'      => 'required',
            'email'     => 'required|unique:users',
            'password'  => 'required',
            'getway_id' => 'required',
            'trx'       => 'required|unique:orders,trx',
            'plan_id'   => 'required',
            'tenant'    => 'required|unique:tenants,id',
            'status'    => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'      => 'Customer name field is required',
            'email.required'     => 'Customer email field is required',
            'email.unique'       => 'The customer email used in this application . Try another!',
            'password.required'  => 'Password field is required',
            'getway_id.required' => 'Payment gateway field is required',
            'trx.required'       => 'Transaction id field is required',
            'trx.unique'         => 'Transaction id in this application . Try another !',
            'plan_id.required'   => 'Plan field is required',
            'tenant.required'    => 'Profile name field is required',
            'tenant.unique'      => 'Profile name used in this application . Try another!',
            'status.required'    => 'Status  field is required',
        ];
    }
}
