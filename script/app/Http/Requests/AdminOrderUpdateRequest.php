<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminOrderUpdateRequest extends FormRequest
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
            "trx"          => ['required', Rule::unique('orders', 'trx')->ignore($this->order, 'id')],
            'plan_id'      => 'required',
            'email_status' => 'required',
            'status'       => 'required',
        ];
    }
    public function messages()
    {
        return [
            'email.required'        => 'Email field is required',
            'tenant.required'       => 'Tenant field is required',
            'getway_id.required'    => 'Payment gateway field is required',
            'trx.required'          => 'Trx id field is required',
            'trx.unique'            => 'Trx id field need unique number',
            'plan_id.required'      => 'Plan field is required',
            'email_status.required' => 'Send email to customer? field is required',
            'status.required'       => 'Status field is required',
        ];
    }
}
