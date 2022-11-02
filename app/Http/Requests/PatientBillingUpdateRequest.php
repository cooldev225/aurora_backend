<?php

namespace App\Http\Requests;

use App\Enum\PatientBillingType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

/**
* @bodyParam member_number               required         string           The member number of the billing record
* @bodyParam member_reference_number                      string           The reference number of the billing record
* @bodyParam health_fund_id                               number           The ID of the patients health fund
* @bodyParam has_medicare_concession                      boolean          Whether or not the patient has a medicare concession
* @bodyParam is_valid                                     boolean          Whether or not the billing record is valid
*/
class PatientBillingUpdateRequest extends FormRequest
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
            'member_number'           => 'required|alphanum|min:1|max:19',
            'member_reference_number' => 'nullable|string',
            'health_fund_id'          => 'nullable|string|max:3',
            'has_medicare_concession' => 'nullable|boolean',
            'is_valid'                => 'required|boolean',
        ];
    }
}
