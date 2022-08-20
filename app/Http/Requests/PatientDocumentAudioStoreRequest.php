<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientDocumentAudioStoreRequest extends FormRequest
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
            'patient_id'    => 'integer|required',
            'specialist_id' => 'integer|required',
            'file'          => 'required',
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
            'specialist_id' => [
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
