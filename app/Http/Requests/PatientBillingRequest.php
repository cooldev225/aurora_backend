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
            'patient_id' => 'required|numeric',
            'medicare_expiry_date' => 'date',
            'concession_expiry_date' => 'date',
            'pension_expiry_date' => 'date',
            'healthcare_card_expiry_date' => 'date',
            'health_fund_id' => 'required|numeric',
        ];
    }
}
