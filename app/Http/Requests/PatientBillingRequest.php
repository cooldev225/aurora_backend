<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam medicare_number                 number           The patients medicare number
* @bodyParam medicare_reference_number       number           The patients medicare reference number
* @bodyParam medicare_expiry_date            date             The patients medicare expiry date
* @bodyParam concession_number               number           The patients concession card number
* @bodyParam concession_expiry_date          date             The patients concession card expiry date
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
            'medicare_number'               => 'nullable|numeric',
            'medicare_reference_number'     => 'nullable|numeric',
            'medicare_expiry_date'          => 'nullable|date',

            'pension_card_number'           => 'nullable|numeric',
            'pension_card_date'             => 'nullable|date',

            'concession_number'             => 'nullable|numeric',
            'concession_expiry_date'        => 'nullable|date',

            'health_care_card_number'       => 'nullable|numeric',
            'health_care_card_date'         => 'nullable|date',

            'health_fund_id'                => 'nullable|numeric|exists:health_funds,id',
            'health_fund_membership_number' => 'nullable|numeric',
            'health_fund_reference_number'  => 'nullable|numeric',
            'health_fund_expiry_date'       => 'nullable|date',
        ];
    }
}
