<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientDocumentRequest extends FormRequest
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
            'document_name'  => 'required',
            'document_type'  => 'required|in:LETTER,REPORT,CLINICAL_NOTE,PATHOLOGY_REPORT,AUDIO,USB_CAPTURE,OTHER',
            'appointment_id' => 'sometimes',
            'specialist_id'  => 'numeric',
            'file'           => 'required',
            'is_seen'        => 'boolean',
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
            'document_name' => [
                'description' => '',
                'example'     => '',
            ],
            'document_type' => [
                'description' => '',
                'example'     => '',
            ],
            'file' => [
                'description' => '',
                'example'     => '',
            ],
        ];
    }
}
