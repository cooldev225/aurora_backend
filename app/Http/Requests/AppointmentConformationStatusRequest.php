<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentConformationStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $appointment = $this->route('appointment');
        $organization_id = auth()->user()->organization_id;
        if ($appointment->organization_id == $organization_id) {
            return true;
        }
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
            'confirmation_status' => 'in:PENDING,CONFIRMED,CANCELED,MISSED',
            'confirmation_status_reason' => '',
        ];
    }

    /**
     * Get the description of body parameters.
     *
     * @return array<string, array>
     */
    public function bodyParameters()
    {
        return [
            'confirmation_status'  => [
                'description' => 'The appointment confirmation Status: PENDING,CONFIRMED,CANCELLED,MISSED',
                'example'     => 'CANCELLED',
            ],
            'confirmation_status_reason'  => [
                'description' => 'The reason this confirmation status was set',
                'example'     => 'They patient was too sick to attend',
            ],
        ];
    }
}
