<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/**
* @bodyParam name               string   required
* @bodyParam max_clinics        number   required
* @bodyParam max_employees      number   required
* @bodyParam appointment_length number   required
* @bodyParam start_time         number   required
* @bodyParam end_time           number   required
* @bodyParam has_billing        bool     required
* @bodyParam has_coding         bool     required
*/
class OrganizationSettingUpdateRequest extends FormRequest
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
            'name'                          => 'required|string',
            'start_time'                    => 'required|string|date_format:H:i:s',
            'end_time'                      => 'required|string|date_format:H:i:s',
            'appointment_length'            => 'required|numeric',
            'abn_acn'                       => 'required|numeric',
            'logo'                          => 'nullable',
        ];
    }
}
