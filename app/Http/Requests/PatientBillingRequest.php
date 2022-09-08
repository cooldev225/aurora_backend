<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam medicare_number                 number  required The patients medicare number
* @bodyParam medicare_reference_number       number  required The patients medicare reference number
* @bodyParam medicare_expiry_date            date    required The patients medicare expiry date
* @bodyParam pension_card_number             number           The patients pension card number
* @bodyParam pension_card_date               date             The patients pension card expiry date
* @bodyParam health_care_card_number         number           The patients health care card number
* @bodyParam health_care_card_date           date             The patients health care card expiry date
* @bodyParam health_fund_id                  number           The patients health fund id
* @bodyParam health_fund_membership_number   number           The patients health fund membership number
* @bodyParam health_fund_reference_number    number           The patients health fund reference number   
* @bodyParam health_fund_expiry_date         date             The patients health fund expiry date
*/
class PatientBillingRequest extends FormRequest
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
            'medicare_number'               => 'required|numeric',
            'medicare_reference_number'     => 'required|numeric',
            'medicare_expiry_date'          => 'required|date',

            'pension_card_number'           => 'numeric',
            'pension_card_date'             => 'date',

            'health_care_card_number'       => 'numeric',
            'health_care_card_date'         => 'date',

            'health_fund_id'                => 'numeric',
            'health_fund_membership_number' => 'numeric',
            'health_fund_reference_number'  => 'numeric', 
            'health_fund_expiry_date'       => 'date',
            
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
            'patient_id' => [
                'description' => '',
                'example'     => '',
            ],
            'medicare_expiry_date' => [
                'description' => '',
                'example'     => '',
            ],
            'concession_expiry_date' => [
                'description' => '',
                'example'     => '',
            ],
            'pension_expiry_date' => [
                'description' => '',
                'example'     => '',
            ],
            'healthcare_card_expiry_date' => [
                'description' => '',
                'example'     => '',
            ],
            'health_fund_id' => [
                'description' => '',
                'example'     => '',
            ],
        ];
    }
}
