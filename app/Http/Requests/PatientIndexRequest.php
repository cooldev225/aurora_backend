<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam first_name      string   required  The first name of the patient being searched for    Example: Sam
* @bodyParam last_name       string   required  The last name of the patient being searched for     Example: Citizen
* @bodyParam date_of_birth   date     required  The date of birth of the patient being search for   Example: 1992-01-01
*/
class PatientIndexRequest extends FormRequest
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
            'first_name'    => 'nullable|string',
            'last_name'     => 'nullable|string',
            'date_of_birth' => 'nullable|date',
        ];
    }
}
