<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam confirmation_status          enum     required  The appointment confirmation status: PENDING,CONFIRMED,CANCELLED,MISSED   Example: CANCELLED
* @bodyParam confirmation_status_reason   string             The reason this confirmation status was set                               Example: The patient was too sick to attend
*/
class AppointmentConfirmationStatusUpdateRequest extends FormRequest
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
            'confirmation_status'        =>  ['required','in:PENDING,CONFIRMED,CANCELED,MISSED'],
            'confirmation_status_reason' => 'nullable',
        ];
    }
}
