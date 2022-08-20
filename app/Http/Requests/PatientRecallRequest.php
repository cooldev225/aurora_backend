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
            'patient_id'        =>  'required|numeric',
            'organization_id'   =>  'required|numeric',
            'time_frame'        =>  'required|numeric',
            'reason'            =>  'string'
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
            'patient_id' => [
                'description' => '',
                'example'     => '',
            ],
            'organization_id' => [
                'description' => '',
                'example'     => '',
            ],
            'time_frame' => [
                'description' => '',
                'example'     => '',
            ],
            'reason' => [
                'description' => '',
                'example'     => '',
            ],
        ];
    }
}
