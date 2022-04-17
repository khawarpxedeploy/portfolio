<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuCustomizeRequest extends FormRequest
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
            'text'   => 'required',
            'icon'   => 'required',
            'href'   => 'required|url',
            'target' => 'required',
            'title'  => 'required',
        ];
    }
    public function messages()
    {
        return [
            'text.required'   => 'Text field is required',
            'icon.required'   => 'Please select icon',
            'href.required'   => 'URL field is required',
            'href.url'        => 'URL field need validate url',
            'target.required' => 'Target  field is required',
            'title.required'  => 'Tooltip field is required',
        ];
    }
}
