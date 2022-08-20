<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
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
            'name'          => 'required',
            'username'      => 'required|string|min:2|max:100',
            'email'         => 'required|string|email|max:100', //'|unique:users',
            'first_name'    => 'string',
            'last_name'     => 'string',
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
            'name' => [
                'description' => '',
                'example'     => '',
            ],
            'username' => [
                'description' => '',
                'example'     => '',
            ],
            'email' => [
                'description' => '',
                'example'     => '',
            ],
            'first_name' => [
                'description' => '',
                'example'     => '',
            ],
            'last_name' => [
                'description' => '',
                'example'     => '',
            ],
        ];
    }
}
