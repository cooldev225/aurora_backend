<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam patient_id      string  required  The id of the patient this alert  is for    
* @bodyParam alert_level     string         required  The level of the alert       Example: DANGER
* @bodyParam tile  required  title for the alert   Example:Aggressive 
* @bodyParam explanation    Explanation for the alert   Example:on date something happened
*/
class PatientAlertRequest extends FormRequest
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
            'patient_id'        => 'required|numeric|exists:patients,id',
            'alert_level'       => 'required|in:NOTICE,WARNING,BLACKLISTED',
            'title'             => 'required|string',
            'explanation'       => 'nullable|string',
        ];
    }
}
