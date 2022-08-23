<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $patient = $this->route('patient');
        $organization_id = auth()->user()->organization_id;
        if ($patient->isPartOfOrganization($organization_id)) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'             => '',
            'first_name'        => 'required',
            'last_name'         => 'required',
            'date_of_birth'     => 'required',
            'contact_number'    => 'required',
            'gender'            => '',
            'address'           => '',
            'marital_status'    => '',
            'birth_place_code'  => '',
            'country_of_birth'  => '',
            'birth_state'       => '',
            'allergies'         => '',
            'aborginality'      => '',
            'occupation'        => '',
            'height'            => '',
            'weight'            => '',
            'appointment_confirm_method' => '',
            'preferred_contact_method' => '',
            'send_recall_method'=> '',
            'kin_name'          => '',
            'kin_relationship'  => '',
            'kin_phone_number'  => '',
            'clinical_alerts'   => '',
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
            'title' => [
                'description' => 'The patients preferred title',
                'example'     => 'Miss',
            ],
            'first_name' => [
                'description' => 'The patients first name',
                'example'     => 'Jessica',
            ],
            'last_name' => [
                'description' => 'The patients last name',
                'example'     => 'Smith',
            ],
            'date_of_birth' => [
                'description' => 'The patients date of birth',
                'example'     => '1993-10-09',
            ],
            'contact_number' => [
                'description' => 'The patients contact number',
                'example'     => '04-8234-2342',
            ],
            'gender' => [
                'description' => 'The patients gender',
                'example'     => 'Undisclosed',
            ],
            'address' => [
                'description' => 'The patients address',
                'example'     => '14 Panorama Dr, Mildura',
            ],
            'birth_place_code' => [
                'description' => 'The patients birth place code',
                'example'     => 'AU242',
            ],
            'country_of_birth' => [
                'description' => 'The patients birth country',
                'example'     => 'Australia',
            ],
            'birth_state' => [
                'description' => 'The patients birth state',
                'example'     => 'Victoria',
            ],
            'allergies' => [
                'description' => 'The patients allergies',
                'example'     => 'Allergic rhinitis (hay fever), eczema, hives',
            ],
            'aborginality' => [
                'description' => 'Does the patient identify as an Aboriginal or Torres Strait Islander',
                'example'     => '1',
            ],
            'occupation' => [
                'description' => 'The patients occupation',
                'example'     => 'Student',
            ],
            'height' => [
                'description' => 'The patients reported height (cm)',
                'example'     => '175',
            ],
            'weight' => [
                'description' => 'The patients reported weight (kg)',
                'example'     => '96',
            ],
            'appointment_confirm_method' => [
                'description' => 'The patients preferred appointment confirm method',
                'example'     => 'SMS',
            ],
            'send_recall_method' => [
                'description' => 'The patients preferred send recall confirm method',
                'example'     => 'MAIL',
            ],
            'kin_name' => [
                'description' => 'The patients next of kin name',
                'example'     => 'Josh Doe',
            ],
            'kin_relationship' => [
                'description' => 'The patients next of kin relationship',
                'example'     => 'Father',
            ],
            'kin_phone_number' => [
                'description' => 'The patients next of kin phone number',
                'example'     => '04-8234-2342',
            ],
            'clinical_alerts' => [
                'description' => 'The patient clinical alerts',
                'example'     => 'Jessica is permanently ina wheelchair',
            ],
          
        ];
    }
}
