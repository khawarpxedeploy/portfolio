<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyTeamUpdateRequest extends FormRequest
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
            "avatar"   => "image|max:5120",
            "name"     => "required|max:50",
            "position" => "required|max:50",
        ];
    }
    public function messages()
    {
        return [
            'name.required'     => ' Name field is required',
            'name.max'          => ' Name field max character 50',
            'avatar.max'        => 'Avatar field max file size 5 mb',
            'avatar.image'      => 'Avatar field only take image file like (jpg,png,jpeg etc)',
            'position.required' => 'Position field is required',
            'position.max'      => 'Position field max character 50',
        ];
    }
}
