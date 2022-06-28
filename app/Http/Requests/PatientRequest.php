<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (
            in_array(
                auth()
                    ->user()
                    ->role()->slug,
                ['admin', 'organizationAdmin', 'orgnaization-manger']
            )
        ) {
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
            'username' => 'required|string|min:2|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'marital_status' => 'required',
            'aborginality' => 'required|numeric',
            'appointment_confirm_method' => 'required',
            'send_recall_method' => 'required|in:email,mail',
        ];
    }
}
