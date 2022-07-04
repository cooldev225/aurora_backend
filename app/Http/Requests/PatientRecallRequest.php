<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'specialist_id' => 'required|numeric',
            'organization_id' => 'required|numeric',
            'patient_id' => 'required|numeric',
            'appointment_id' => 'required|numeric',
            'notification_template_id' => 'required|numeric',
            'recall_sent_date' => 'required|date',
            'appointment_date' => 'required|date',
        ];
    }
}
