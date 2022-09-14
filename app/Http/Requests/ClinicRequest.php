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
* @bodyParam document_letter_header             string   required   The document header of the clinic                    Example: Example Practice
* @bodyParam document_letter_footer             string   required   The document footer of the clinic                    Example: Example Practice
* @bodyParam specimen_collection_point_number   string   required   The specimen collection point number of the clinic   Example: 123456
* @bodyParam lspn_id                            int      required   The LSPN id of the clinic                            Example: 123456
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
            'name'                             => 'required',
            'email'                            => 'required',
            'phone_number'                     => 'required',
            'address'                          => 'required',
            'fax_number'                       => '',
            'hospital_provider_number'         => '',
            'VAED_number'                      => '',
            'document_letter_header'           => '',
            'document_letter_footer'           => '',
            'specimen_collection_point_number' => '',
            'lspn_id'                          => '',
        ];
    }
}
