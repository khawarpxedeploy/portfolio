<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
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
            'name'     => 'required|max:50',
            'roles'    => 'required',
            "email"    => ['required|max:100|email', Rule::unique('users', 'email')->ignore($this->doctor, 'id')],
            "phone"    => ['required|max:20', Rule::unique('users', 'phone')->ignore($this->doctor, 'id')],
            // 'email'    => 'required|max:100|email|unique:users',
            // 'phone'    => 'required|max:20|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
    }
    public function messages()
    {
        return [
            'name.required'     => ' Name field is required',
            'name.max'          => ' Name field max character is 50',
            'roles.required'    => 'Roles field is required',
            'image.max'         => 'Blog image field max file size 2024kb',
            'email.required'    => 'Email field is required',
            'email.unique'      => 'This email is used in this application',
            'phone.required'    => 'Phone  field is required',
            'phone.unique'      => 'This phone number is used in this application',
            'password.required' => 'Password field is required',
            'password.min'      => 'Password field need min 6 character',
        ];
    }
}
