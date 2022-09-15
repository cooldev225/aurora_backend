<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam last_name       string  required  The last name of the patient   Example: Citizen
* @bodyParam date_of_birth   date    required  The patients date of birth     Example: 1992-01-01
*/
class AppointmentPreAdmissionValidateRequest extends FormRequest
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
            'last_name'     => 'required|string',
            'date_of_birth' => 'required|date'
        ];
    }
}
