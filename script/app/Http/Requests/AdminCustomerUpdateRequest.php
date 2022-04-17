<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminCustomerUpdateRequest extends FormRequest
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
            "name"   => ['required', Rule::unique('users', 'name')->ignore($this->customer, 'id')],
            "email"  => ['required', Rule::unique('users', 'email')->ignore($this->customer, 'id')],
            "user_name"  => ['required', Rule::unique('tenants', 'id')->ignore($this->customer, 'user_id')],
            'status' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'   => 'Customer name field is required',
            'name.unique'     => 'The customer name used in this application . Try another!',
            'email.required'  => 'Customer email field is required',
            'email.unique'    => 'The customer email used in this application . Try another!',
            'status.required' => 'Status field is required',
            'user_name.unique'    => 'The Username used in this application . Try another!',
            'user_name.required' => 'User_name field is required',
        ];
    }
}
