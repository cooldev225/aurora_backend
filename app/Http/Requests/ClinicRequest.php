<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam name                               string   required   The name of the clinic                               Example: Example Practice
* @bodyParam email                              string   required   The Email of the clinic                              Example: practice@test.com
* @bodyParam phone_number                       string   required   The Phone number of the clinic                       Example: 04-1234-5678
* @bodyParam address                            string   required   The address of the clinic                            Example: 123 Example St, Melbourne
* @bodyParam fax_number                         string   required   The fax number of the clinic                         Example: 03-4321-8765
* @bodyParam hospital_provider_number           string   required   The provider number of the clinic                    Example: 12345678F
* @bodyParam VAED_number                        string   required   The VAED number of the clinic                        Example: 123456
* @bodyParam specimen_collection_point_number   string   required   The specimen collection point number of the clinic   Example: 123456
* @bodyParam lspn_id                            int      required   The LSPN id of the clinic                            Example: 123456
* @bodyParam healthlink_edi                     string   
*/
class ClinicRequest extends FormRequest
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
            'name'                             => 'required|string',
            'nickname_code'                    => 'required|string',
            'email'                            => 'required|email',
            'phone_number'                     => 'required|string',
            'address'                          => 'required|string',
            'fax_number'                       => 'required|string',
            'hospital_provider_number'         => 'required|string',
            'VAED_number'                      => 'required|string',
            'specimen_collection_point_number' => 'required|string',
            'lspn_id'                          => 'required|numeric',
            'healthlink_edi'                   => 'string',
            'minor_id'                         => 'string',
            'nickname_code'                    => 'string',

        ];
    }
}
