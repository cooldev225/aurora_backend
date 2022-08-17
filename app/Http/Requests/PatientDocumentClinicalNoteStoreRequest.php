<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientDocumentClinicalNoteStoreRequest extends FormRequest
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
            'appointment_id'        => 'integer|required',
            'description'           => 'string|required',
            'diagnosis'             => 'string|required',
            'clinical_assessment'   => 'string|required',
            'treatment'             => 'string|required',
            'history'               => 'string|required',
            'additional_details'    => 'string|required',
        ];
    }
}
