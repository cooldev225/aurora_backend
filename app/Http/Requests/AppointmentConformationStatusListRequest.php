<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentConformationStatusListRequest extends FormRequest
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
            'confirmation_status' => ['required','in:PENDING,CONFIRMED,CANCELED,MISSED'],
            'appointment_range' => ['required','in:FUTURE,PAST,ALL'],
        ];
    }

    /**
     * Get the description of body parameters.
     *
     * @return array<string, array>
     */
    public function bodyParameters()
    {
        return [
            'confirmation_status'  => [
                'description' => 'The appointment confirmation Status in request: PENDING,CONFIRMED,CANCELLED,MISSED',
                'example'     => 'CANCELLED',
            ],
            'appointment_range'  => [
                'description' => 'The range off appointment to return: FUTURE,PAST,ALL',
                'example'     => 'FUTURE',
            ],
        ];
    }
}
