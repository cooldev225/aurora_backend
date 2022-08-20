<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecialistClinicRelationRequest extends FormRequest
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
            'clinic_id'     => 'required|numeric',
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
            'specialist_id' => [
                'description' => '',
                'example'     => '',
            ],
            'clinic_id' => [
                'description' => '',
                'example'     => '',
            ],
        ];
    }
}
