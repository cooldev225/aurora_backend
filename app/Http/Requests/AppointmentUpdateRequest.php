<?php

namespace App\Http\Requests;

use App\Enum\ChargeType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

/**
* @bodyParam title                           string     required   The patients preferred title                                           Example: Miss
* @bodyParam first_name                      string     required   The patients first name                                                Example: Jessica
* @bodyParam last_name                       string     required   The patients last name                                                 Example: Smith
* @bodyParam date_of_birth                   date       required   The patients date of birth                                             Example: 1993-10-09
* @bodyParam contact_number                  string     required   The patients contact number                                            Example: 04-8234-2342
* @bodyParam gender                          string     required   The patients gender                                                    Example: Undisclosed
* @bodyParam address                         string     required   The patients address                                                   Example: 14 Panorama Dr, Mildura
* @bodyParam marital_status                  string     required   The patients martial status                                            Example: SINGLE
* @bodyParam birth_place_code                string     required   The patients birth place code                                          Example: AU242
* @bodyParam country_of_birth                string     required   The patients birth country                                             Example: Australia
* @bodyParam birth_state                     string     required   'The patients birth state                                              Example: Victoria
* @bodyParam allergies                       string     required   The patients allergies                                                 Example: Allergic rhinitis (hay fever), eczema, hives
* @bodyParam aborginality                    bool       required   Does the patient identify as an Aboriginal or Torres Strait Islander   Example: true
* @bodyParam occupation                      string     required   The patients occupation                                                Example: Student
* @bodyParam height                          int        required   The patients reported height (cm)                                      Example: 175
* @bodyParam weight                          int        required   The patients reported weight (kg)                                      Example: 96
* @bodyParam appointment_confirm_method      enum       required   The patients preferred appointment confirm method (SMS, EMAIL, MAIL)   Example: SMS
* @bodyParam send_recall_method              enum       required   The patients preferred send recall confirm method (SMS, EMAIL, MAIL)   Example: MAIL
* @bodyParam kin_name                        string     required   The patients next of kin name                                          Example: Josh Doe
* @bodyParam kin_relationship                string     required   The patients next of kin relationship                                  Example: Father
* @bodyParam kin_phone_number                string     required   The patients next of kin phone number                                  Example: 04-8234-2342
* @bodyParam clinical_alerts                 string     required   The patient clinical alerts                                            Example: Jessica is permanently in a wheelchair
*
* @bodyParam medicare_number                 number                The patients medicare number
* @bodyParam medicare_reference_number       number                The patients medicare reference number
* @bodyParam medicare_expiry_date            date                  The patients medicare expiry date
* @bodyParam concession_number               number                The patients concession card number
* @bodyParam concession_expiry_date          date                  The patients concession card expiry date
* @bodyParam pension_card_number             number                The patients pension card number
* @bodyParam pension_card_date               date                  The patients pension card expiry date
* @bodyParam health_care_card_number         number                The patients health care card number
* @bodyParam health_care_card_date           date                  The patients health care card expiry date
* @bodyParam health_fund_id                  number                The patients health fund id
* @bodyParam health_fund_membership_number   number                The patients health fund membership number
* @bodyParam health_fund_reference_number    number                The patients health fund reference number   
* @bodyParam health_fund_expiry_date         date                  The patients health fund expiry date
*
* @bodyParam referring_doctor_id             int        required   The id of the referring doctor                                         Example: 2
* @bodyParam referral_date                   date       required   The date the referral was issued                                       Example: 1993-23-03
* @bodyParam referral_duration               int        required   The duration the referral is valid                                     Example: 3
* @bodyParam file                            file                  The referral file
*
* @bodyParam room_id                         int        required   The ID of the room where the appointment is occurring
* @bodyParam appointment_type_id             int        required   The ID of the appointment type
* @bodyParam time_slot                       string     required   The time slot of the appointment
* @bodyParam note                            string     required   Notes for the appointment
* @bodyParam charge_type                     enum       required   The charge type for the appointment
*/
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
