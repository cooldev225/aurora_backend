<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam photo        file              The users profile photo
*
* @bodyParam first_name   string  required  The first name of the user          Example: Sam
* @bodyParam last_name    string  required  The last name of the user           Example: Citizen
* @bodyParam email        string  required  The users email address             Example: sam.citizen@user.com
* @bodyParam role_id      enum    required  The ID of the users assigned role   Example: 1
*/
class ProfileUpdateRequest extends FormRequest
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
        $user_request = new UserRequest();

        return [
            'photo' => 'mimes:jpg,png,bmp',

            ...$user_request->rules(),
        ];
    }
}
