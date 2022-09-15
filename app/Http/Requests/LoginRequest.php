<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam username   string   required  The username being used to log in (required if no email is provided)
* @bodyParam password   string   required  The password to log in
* @bodyParam email      string   required  The email to log in (required if no username is provided)
*/
class LoginRequest extends FormRequest
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
            'username' => 'required_if:email,null|string|min:2|max:100',
            'email'    => 'required_if:username,null|email',
            'password' => 'required|string|min:6',
        ];
    }
}
