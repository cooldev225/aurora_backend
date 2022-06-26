<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientAdministrationInfoRequest extends FormRequest
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
            'patient_id' => 'required|numeric',
            'appointment_id' => 'required|numeric',
            'referring_doctor_id' => 'required|numeric',
            'is_no_referral' => 'required|boolean',
            'aborginality' => 'required|numeric',
            'referal_date' => 'date',
            'referal_expiry_date' => 'date',
        ];
    }
}
