<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam alert_level     string         required  The level of the alert       Example: DANGER
* @bodyParam explanation  required  Explanation for the alert   Example:This patient is aggressive 
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
            'alert_level'       => 'required|in:NOTICE,WARNING,BLACKLISTED',
            'explanation'       => 'required|string',
        ];
    }
}
