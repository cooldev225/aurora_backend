<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam old_password       string   required   The users old password
* @bodyParam new_password       string   required   The new password the user wants to use (must not be the same as old_password)
* @bodyParam confirm_password   string   required   A confirmation of the users new password (must match new_password)
*/
class PasswordUpdateRequest extends FormRequest
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
            'id'               => 'nullable|integer',
            'old_password'     => 'required|string|min:6',
            'new_password'     => 'required|string|min:6|different:old_password',
            'confirm_password' => 'required|string|min:6|same:new_password',
        ];
    }
}
