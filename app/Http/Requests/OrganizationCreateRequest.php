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
* @bodyParam has_billing        bool      
* @bodyParam has_coding         bool      
* @bodyParam email              string   required 
* @bodyParam first_name         string   required 
* @bodyParam last_name          string   required 
* @bodyParam mobile_number      string   required 
*/
class OrganizationCreateRequest extends FormRequest
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
            'max_clinics'         => 'required|numeric',
            'max_employees'       => 'required|numeric',
            'appointment_length'  => 'required|numeric',
            'start_time'          => 'required|date_format:H:i',
            'end_time'            => 'required|date_format:H:i',
            'has_billing'         => 'boolean',
            'has_coding'          => 'boolean',
            'email'               => 'required|string|email|max:100',
            'first_name'          => 'required|string',
            'last_name'           => 'required|string',
            'mobile_number'       => 'required|string',
        ];
    }
}
