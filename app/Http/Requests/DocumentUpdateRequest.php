<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentUpdateRequest extends FormRequest
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
            'patient_id'                    => 'nullable|integer',
            'document_id'                   => 'nullable|integer',
            'is_read'                       => 'nullable|integer',
            'is_urgent'                     => 'nullable|integer',
            'is_incorrectly_assigned'       => 'nullable|integer',
            'appointment_id'                => 'nullable|integer',
            'specialist_id'                 => 'nullable|integer',
            'document_name'                 =>  'required|string',
            'document_type'                 => 'required|in:LETTER,REPORT,CLINICAL_NOTE,PATHOLOGY_REPORT,AUDIO,USB_CAPTURE,OTHER',
        ];
    }
}
