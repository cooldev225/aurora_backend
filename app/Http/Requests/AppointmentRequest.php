<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'name' => 'required',
            'patient_id' => 'required|numeric',
            'clinic_id' => 'required|numeric',
            'appointment_type_id' => 'required|numeric',
            'primary_pathologist_id' => 'numeric',
            'specialist_id' => 'required|numeric',
            'anesthetist_id' => 'required|numeric',
            'room_id' => 'required|numeric',
            'reference_number' => 'required|numeric',
            'date' => 'required|date',
            'arrival_time' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'actual_start_time' => 'required',
            'actual_end_time' => 'required',
            'charge_type' => 'required',
            'is_waitlisted' => 'required|boolean',
            'skip_coding' => 'required|boolean',
        ];
    }
}
