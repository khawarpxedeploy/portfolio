<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminBenefitRequest extends FormRequest
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
            'title'   => 'required|max:50',
            'image'   => 'image|max:5120',
            'excerpt' => 'required|max:200',
        ];
    }
    public function messages()
    {
        return [
            'title.required'   => 'Title field is required',
            'title.max'        => 'Title field max character 50',
            'excerpt.required' => 'Short content field is required',
            'excerpt.max'      => 'Short content field max character 200',
            'image.size'       => 'Image field max file size 5 MB',
            'image.image'      => 'Image input file must be like (png, jpg, jpeg etc)',
        ];
    }
}
