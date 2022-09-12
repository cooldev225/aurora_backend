<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentAttendanceStatusCheckInRequest extends FormRequest
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
            'referring_doctor_id' => 'nullable|required_with:referral_date,referral_duration|exists:referring_doctors',
            'referral_date'       => 'nullable|required_with:referring_doctor_id,referral_duration|date',
            'referral_duration'   => 'nullable|required_with:referring_doctor_id,referral_date|numeric',
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
            'referring_doctor_id'  => [
                'description' => 'The ID of the referring doctor',
            ],
            'referral_date'  => [
                'description' => 'The date of the referral',
            ],
            'referral_duration'  => [
                'description' => 'The duration of the referral',
            ],
        ];
    }
}
