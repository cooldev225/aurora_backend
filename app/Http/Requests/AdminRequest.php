<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam username     string   required   The username to be given to the admin user
* @bodyParam email        number   required   The email address of the user
*/
class AdminRequest extends FormRequest
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
            'email'     => 'required|string|email|max:100',
        ];
    }
}
