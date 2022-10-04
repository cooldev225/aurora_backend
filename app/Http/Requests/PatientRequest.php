<?php

namespace App\Http\Requests;

use App\Enum\NotificationMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

/**
* @bodyParam title                        string   nullable   The patients preferred title                                           Example: Miss
* @bodyParam first_name                   string   required   The patients first name                                                Example: Jessica
* @bodyParam last_name                    string   required   The patients last name                                                 Example: Smith
* @bodyParam date_of_birth                date     required   The patients date of birth                                             Example: 1993-10-09
* @bodyParam contact_number               string   required   The patients contact number                                            Example: 04-8234-2342
* @bodyParam gender                       string   required   The patients gender                                                    Example: Undisclosed
* @bodyParam address                      string   required   The patients address                                                   Example: 14 Panorama Dr, Mildura
* @bodyParam marital_status               string   required   The patients martial status                                            Example: SINGLE
* @bodyParam birth_place_code             string   required   The patients birth place code                                          Example: AU242
* @bodyParam country_of_birth             string   required   The patients birth country                                             Example: Australia
* @bodyParam birth_state                  string   required   'The patients birth state                                              Example: Victoria
* @bodyParam allergies                    string   required   The patients allergies                                                 Example: Allergic rhinitis (hay fever), eczema, hives
* @bodyParam aborginality                 bool     required   Does the patient identify as an Aboriginal or Torres Strait Islander   Example: true
* @bodyParam occupation                   string   required   The patients occupation                                                Example: Student
* @bodyParam height                       int      required   The patients reported height (cm)                                      Example: 175
* @bodyParam weight                       int      required   The patients reported weight (kg)                                      Example: 96
* @bodyParam appointment_confirm_method   enum     required   The patients preferred appointment confirm method (SMS, EMAIL, MAIL)   Example: SMS
* @bodyParam send_recall_method           enum     required   The patients preferred send recall confirm method (SMS, EMAIL, MAIL)   Example: MAIL
* @bodyParam kin_name                     string   required   The patients next of kin name                                          Example: Josh Doe
* @bodyParam kin_relationship             string   required   The patients next of kin relationship                                  Example: Father
* @bodyParam kin_phone_number             string   required   The patients next of kin phone number                                  Example: 04-8234-2342
* @bodyParam clinical_alerts              string   required   The patient clinical alerts                                            Example: Jessica is permanently in a wheelchair
*/
class PatientRequest extends FormRequest
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
            'title'                      => 'nullable|string',
            'first_name'                  => 'required|string',
            'last_name'                  => 'required|string',
            'date_of_birth'              => 'required',
            'contact_number'             => 'nullable|string',
            'gender'                     => 'nullable|string',
            'address'                    => 'nullable|string',
            'marital_status'             => 'nullable|string',
            'birth_place_code'           => 'nullable|string',
            'country_of_birth'           => 'nullable|string',
            'birth_state'                => 'nullable|string',
            'allergies'                  => 'nullable|string',
            'aborginality'               => 'nullable|boolean',
            'occupation'                 => 'nullable|string',
            'height'                     => 'nullable|numeric',
            'weight'                     => 'nullable|numeric',
            'appointment_confirm_method' => ['nullable', new Enum(NotificationMethod::class)],
            'send_recall_method'         => ['nullable', new Enum(NotificationMethod::class)],
            'kin_name'                   => 'nullable|string',
            'kin_relationship'           => 'nullable|string',
            'kin_phone_number'           => 'nullable|string',
            'clinical_alerts'            => 'nullable|string',
        ];
    }
}
