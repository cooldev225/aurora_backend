<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam old_password       string   required   The users old password
* @bodyParam new_password       string   required   The new password the user wants to use (must not be the same as old_password)
* @bodyParam confirm_password   string   required   A confirmation of the users new password (must match new_password)
*/
class SignatureUpdateRequest extends FormRequest
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
            'signature'     => 'required|string',
        ];
    }
}
