<?php

namespace App\Http\Requests;

use App\Models\Patient;
use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam patient_id      string  required  The id of the patient this recall is for                                   Example: 3
* @bodyParam appointment_id  string  required  The id of the appointment the recall is for                                Example: 3
* @bodyParam time_frame      string  required  The time frame between now and when the recall should be sent in months    Example: 6
* @bodyParam reason          string  required  The reason for the recall                                                  Example: Please return for a follow up consolation  
*/
class PatientRecallRequest extends FormRequest
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
            'patient_id'        =>  'required|numeric|exists:patients,id',
            'appointment_id'    =>  'required|numeric|exists:appointments,id',
            'time_frame'        =>  'required|numeric',
            'reason'            =>  'required|string',
        ];
    }
}
