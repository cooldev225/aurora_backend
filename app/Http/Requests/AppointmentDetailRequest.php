<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentDetailRequest extends FormRequest
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
            'is_complete'              => 'bool',
            'procedures_undertaken'    => 'array',
            'extra_items_used'         => 'array',
            'indication_codes'         => 'string',
            'diagnosis_codes'          => 'string',
        ];
    }
}
