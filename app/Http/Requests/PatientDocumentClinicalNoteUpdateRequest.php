<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientDocumentClinicalNoteUpdateRequest extends FormRequest
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
            'appointment_id'        => 'required',
            'description'           => 'required',
            'diagnosis'             => 'required',
            'clinical_assessment'   => 'required',
            'treatment'             => 'required',
            'history'               => 'required',
            'additional_details'    => 'required',
        ];
    }
}
