<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam role_id      int   required  The role_id to filter user   Example: 3
*/
class UserIndexRequest extends FormRequest
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
            'role_id'       => 'nullable|int',
            'first_name'    => 'nullable|string',
            'last_name'     => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'date' => 'nullable|date',
        ];
    }
}
