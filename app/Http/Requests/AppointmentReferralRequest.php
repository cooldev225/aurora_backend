<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam referring_doctor_id   int   required  The id of the referring doctor       Example: 2
* @bodyParam referral_date         date  required  The date the referral was issued     Example: 1993-23-03
* @bodyParam referral_duration     int   required  The duration the referral is valid   Example: 3
* @bodyParam file                  file            The referral file                    Example:
*/
class AppointmentReferralRequest extends FormRequest
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
            'referring_doctor_id'   => 'required|integer|exists:referring_doctors,id',
            'referral_date'         => 'required|date',
            'referral_duration'     => 'required|integer',
            'file'                  => 'mimes:pdf',
        ];
    }

}
