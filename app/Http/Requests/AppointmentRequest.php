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
            'clinic_id' => 'required|numeric',
            'appointment_type_id' => 'required|numeric',
            'primary_pathologist_id' => 'numeric',
            'specialist_id' => 'required|numeric',
            'anesthetist_id' => 'required|numeric',
            'reference_number' => 'required|numeric',
            'date' => 'required|date',
            'charge_type' => 'required',
            'skip_coding' => 'boolean',
            'room_id' => 'numeric',
            'procedure_price' => 'numeric',
        ];
    }
}
