<?php

namespace App\Http\Requests;

use App\Enum\ChargeType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class AppointmentUpdateRequest extends FormRequest
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
        $patient_request = new PatientRequest();
        $patient_billing_request = new PatientBillingRequest();
        $appointment_referral_request = new AppointmentReferralRequest();
        $appointment_preadmission_request = new AppointmentPreAdmissionRequest();

        return [
            'clinic_id'                 => 'numeric|exists:clinics',
            'appointment_type_id'       => 'required|numeric|exists:appointment_types',
            'specialist_id'             => 'required|numeric|exists:users',
            'date'                      => 'required|date',
            'arrival_time'              => 'required|date',
            'time_slot'                 => 'required|array',
            'note'                      => 'nullable|string',
            'charge_type'               => [new Enum(ChargeType::class)],

            ...$patient_request->rules(),
            ...$patient_billing_request->rules(),
            ...$appointment_referral_request->rules(),
            ...$appointment_preadmission_request->rules(),
        ];
    }


}
