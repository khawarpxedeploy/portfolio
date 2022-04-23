<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialUpdateRequest extends FormRequest
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
            "avatar"      => "nullable|image|max:5120",
            "client_name" => "required|max:50",
            "position"    => "required|max:50",
            "review"      => "required|max:500",
        ];
    }
    public function messages()
    {
        return [
            'client_name.required' => 'Client name field is required',
            'client_name.max'      => 'Client name field Max character 50',
            'avatar.max'           => 'Avatar field max file size 5 mb',
            'avatar.image'         => 'Avatar field only take image file like (jpg,png,jpeg etc)',
            'position.required'    => 'Position field is required',
            'position.max'         => 'Position field max character 50',
            'review.required'      => 'Review message field is required',
            'review.max'           => 'Review message field max character 300',
        ];
    }
}
