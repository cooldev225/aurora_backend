<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam patient_id      string  required  The id of the patient this alert  is for    
* @bodyParam alert_level     string         required  The level of the alert       Example: DANGER
* @bodyParam tile  required  title for the alert   Example:Aggressive 
* @bodyParam explanation    Explanation for the alert   Example:on date something happened
*/
class PatientAlertUpdateRequest extends FormRequest
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
            'alert_level'       => 'sometimes|in:NOTICE,WARNING,BLACKLISTED',
            'title'             => 'sometimes|string',
            'explanation'       => 'sometimes|string',
            'is_dismissed'      => 'required|boolean',
        ];
    }
}
