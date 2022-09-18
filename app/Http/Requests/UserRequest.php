<?php

namespace App\Http\Requests;

use App\Enum\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

/**
* @bodyParam first_name   string  required  The first name of the user          Example: Sam
* @bodyParam last_name    string  required  The last name of the user           Example: Citizen
* @bodyParam email        string  required  The users email address             Example: sam.citizen@user.com
* @bodyParam role_id      enum    required  The ID of the users assigned role   Example: 1
*/
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
            'first_name'     => 'required|string|min:2|max:100',
            'last_name'      => 'required|string|min:2|max:100',
            'email'          => 'required|string|email|max:100',
            'mobile_number'  => 'string',
            'address'        => 'string',
            'mobile_number'  => 'string',
            'role_id'        => ['required', 'int', new Enum(UserRole::class)],
        ];
    }
}
