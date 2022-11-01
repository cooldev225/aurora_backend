<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam doctor_address_book_id   int   required  The id of the doctor address book       Example: 2
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
            'doctor_address_book_id'=> 'nullable|integer|exists:doctor_address_books,id',
            'referral_date'         => 'nullable|date',
            'referral_duration'     => 'nullable|integer',
            'file'                  => 'nullable|mimes:pdf',
        ];
    }

}
