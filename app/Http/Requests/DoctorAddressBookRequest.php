<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam provider_no     string   required  The doctors provider number                                  Example: 12345678
* @bodyParam title           string   required  The title of the doctor                                      Example: Dr.
* @bodyParam first_name      string   required  The doctor address books first name                             Example: Sam
* @bodyParam last_name       string   required  The doctor address books last name                              Example: Citizen
* @bodyParam address         string   required  The full address of the doctor address books practice address   Example: 123 Example St, Melbourne, 3000
* @bodyParam street          string   required  The street of the doctor address books practice address         Example: 123 Example St
* @bodyParam city            string   required  The city of the doctor address books practice address           Example: Melbourne
* @bodyParam state           string   required  The state of the doctor address books practice address          Example: Victoria
* @bodyParam country         string   required  The country of the doctor address books practice address        Example: Australia
* @bodyParam postcode        string   required  The postcode of the doctor address books practice address       Example: 3000
* @bodyParam phone           string   required  The doctor address books phone number                           Example: 03-1234-5678
* @bodyParam fax             string   required  The doctor address books fax number                             Example: 03-4321-8765
* @bodyParam mobile          string   required  The doctor address books mobile number                          Example: 04-5678-4321
* @bodyParam email           string   required  The doctor address books email address                          Example: sam.citizen@doctor.com
* @bodyParam practice_name   string   required  The name of the doctor address books practice                   Example: Sam Citizen's Practice
* @bodyParam healthlink_edi  string                      
*/
class DoctorAddressBookRequest extends FormRequest
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
            'provider_no'   => 'required|string',
            'title'         => 'required|string',
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'address'       => 'required|string',
            'street'        => 'required|string',
            'city'          => 'required|string',
            'state'         => 'required|string',
            'country'       => 'required|string',
            'postcode'      => 'required|string',
            'phone'         => 'required|string',
            'fax'           => 'required|string',
            'mobile'        => 'required|string',
            'email'         => 'required|string',
            'practice_name' => 'required|string',
            'healthlink_edi' => 'string',
        ];
    }
}
