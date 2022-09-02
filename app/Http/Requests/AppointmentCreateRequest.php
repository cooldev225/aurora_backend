<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentCreateRequest extends FormRequest
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
            'clinic_id'                 => 'numeric',
            'appointment_type_id'       => 'required|numeric',
            'specialist_id'             => 'required|numeric',
            'date'                      => 'required|date',
            'start_time'                => 'required|date',
            'end_time'                  => 'required|date',
        ];
    }


}
