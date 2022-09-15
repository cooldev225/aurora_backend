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
class OrganizationUpdateRequest extends FormRequest
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
            'name'                => 'required',
            'max_clinics'         => 'required|number',
            'max-employees'       => 'required|number',
            'appointment_length'  => 'required|number',
            'start_time'          => 'required|date_format:H:i',
            'end_time'            => 'required|date_format:H:i',
            'has_billing'         => 'required|boolean',
            'has_coding'          => 'required|boolean',
        ];
    }
}
