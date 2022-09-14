<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username'  => 'required|string|min:2|max:100',
            'password'  => 'required|string|confirmed|min:6',
            'first_name'  => 'required|string|min:2|max:100',
            'last_name'   => 'required|string|min:2|max:100',
            'email'       => 'required|string|email|max:100',
            'role_id'     => 'required|int',
        ];
    }

    /**
     * Get the description of body parameters.
     *
     * @return array<string, array>
     */
    public function bodyParameters()
    {
        return [
            'username' => [
                'description' => '',
                'example'     => '',
            ],
            'email' => [
                'description' => '',
                'example'     => '',
            ],
            'password' => [
                'description' => '',
                'example'     => '',
            ],
        ];
    }
}
