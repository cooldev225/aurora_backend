<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam collecting_person_name              string  required  The name of the collecting person                 Example: Jessica Jack
* @bodyParam collecting_person_phone             string  required  The phone number of the collecting person         Example: 04-5112-5521
* @bodyParam collecting_person_alternate_contact string  required  The alternate number of the collecting person     Example: 03-2346-2344  
*/
class AppointmentCollectingPersonRequest extends FormRequest
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
            'collecting_person_name'                => 'required|string',
            'collecting_person_phone'               => 'required|string',
            'collecting_person_alternate_contact'   => 'required|string',
        ];
    }
 
}
