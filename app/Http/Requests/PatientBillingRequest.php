<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'patient_id'                    => 'required|numeric',
            'medicare_expiry_date'          => 'date',
            'concession_expiry_date'        => 'date',
            'pension_expiry_date'           => 'date',
            'healthcare_card_expiry_date'   => 'date',
            'health_fund_id'                => 'required|numeric',
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
