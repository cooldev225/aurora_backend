<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam referring_doctor_id   int    The ID of the referring doctor             Example: 1
* @bodyParam referral_date         date   The date of the referral                   Example: 2022-09-01
* @bodyParam referral_duration     int    The duration of the referral (in months)   Example: 4
*/
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
            'referring_doctor_id' => 'nullable|required_with:referral_date,referral_duration|exists:referring_doctors,id',
            'referral_date'       => 'nullable|required_with:referring_doctor_id,referral_duration|date',
            'referral_duration'   => 'nullable|required_with:referring_doctor_id,referral_date|numeric',
        ];
    }
}
