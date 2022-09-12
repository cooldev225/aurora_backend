<?php

namespace App\Http\Requests;

use App\Enum\ChargeType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class AppointmentCreateRequest extends FormRequest
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

        return [
            'room_id'                   => 'nullable|numeric|exists:rooms',
            'appointment_type_id'       => 'required|numeric|exists:appointment_types',
            'time_slot'                 => 'required|array',
            'note'                      => 'nullable|string',
            'charge_type'               => [new Enum(ChargeType::class)],

            ...$patient_request->rules(),
            ...$patient_billing_request->rules(),
            ...$appointment_referral_request->rules(),
        ];
    }


}
