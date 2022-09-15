<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam name                 string  required  The name of the appointment type                                Example: Colonoscopy
* @bodyParam type                 enum    required  The type of the appointment type ('PROCEDURE','CONSULT')        Example: PROCEDURE
* @bodyParam color                string  required  The hex color the appointment will appear in apt book           Example: #eeeeee
* @bodyParam anesthetist_required bool    required  Anesthetist requirement                                         Example: true
* @bodyParam invoice_by           enum    required  Who invoices for the apt  ('CLINIC','SPECIALIST')               Example: CLINIC
* @bodyParam arrival_time         string  required  the amount of time to arrive before the appointment (minutes)   Example: 130
* @bodyParam appointment_time     enum    required  The length of the appointment ('SINGLE','DOUBLE','TRIPLE')      Example: SINGLE
*/
class AppointmentTypeRequest extends FormRequest
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
            'name'                  => 'required|string',
            'type'                  => 'required|in:CONSULTATION,PROCEDURE',
            'color'                 => 'required|string',
            'anesthetist_required'  => 'required|boolean',
            'invoice_by'            => 'required|in:CLINIC,SPECIALIST',
            'arrival_time'          => 'required',
            'appointment_time'      => 'required|in:SINGLE,DOUBLE,TRIPLE',
        ];
    }
}
