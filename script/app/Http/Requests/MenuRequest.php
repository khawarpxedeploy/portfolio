<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'name'     => 'required',
            'position' => 'required',
            'lang'     => 'required',
            'status'   => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'     => 'Menu Name field is required',
            'position.required' => 'Menu Position field is required',
            'lang.required'     => 'Select Language  field is required',
            'status.required'   => 'Menu Status field is required',
        ];
    }
}
