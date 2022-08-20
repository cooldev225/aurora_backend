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
            'clinic_id'                 => 'numeric',
            'appointment_type_id'       => 'required|numeric',
            'primary_pathologist_id'    => 'numeric',
            'specialist_id'             => 'required|numeric',
            'anesthetist_id'            => 'numeric',
            'date'                      => 'required|date',
            'skip_coding'               => 'boolean',
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
            'clinic_id' => [
                'description' => '',
                'example'     => '',
            ],
            'appointment_type_id' => [
                'description' => '',
                'example'     => '',
            ],
            'primary_pathologist_id' => [
                'description' => '',
                'example'     => '',
            ],
            'specialist_id' => [
                'description' => '',
                'example'     => '',
            ],
            'anesthetist_id' => [
                'description' => '',
                'example'     => '',
            ],
            'date' => [
                'description' => '',
                'example'     => '',
            ],
            'skip_coding' => [
                'description' => '',
                'example'     => '',
            ],
        ];
    }
}
