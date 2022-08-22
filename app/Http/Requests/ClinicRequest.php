<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name'                      => 'required',
            'email'                     => 'required',
            'phone_number'              => 'required',
            'address'                   => 'required',
            'fax_number'                => '',
            'hospital_provider_number'  => '',
            'VAED_number'               => '',
            'document_letter_header'    => '',
            'document_letter_footer'    => '',
            'specimen_collection_point_number' => '',
            'lspn_id'                   => '',    
        ];
    }

    /**
     * Get the description of body parameters.
     *
     * @return array<string, array>
     */
    public function bodyParameters()
    {
        return [
            "name" => [
                'description' => 'The name of the clinic',
                'example'     => "Frankston Practice",
            ],
            'email' => [
                'description' => 'The Email of the clinic',
                'example'     => 'reception@franksonpracktice.com.au',
            ],
            'phone_number' => [
                'description' => 'The Phone number of the clinic',
                'example'     => '04-3456-2342',
            ],
            'hospital_provider_number' => [
                'description' => 'The provider number of the clinic',
                'example'     => '31452352F',
            ],
            'VAED_number' => [
                'description' => 'The VAED number of the clinic',
                'example'     => '234234',
            ],
            'specimen_collection_point_number' => [
                'description' => 'The specimen collection point number of the clinic',
                'example'     => '234234',
            ],
            'lspn_id' => [
                'description' => 'The LSPN id of the clinic',
                'example'     => '234234',
            ],
            'document_header' => [
                'description' => 'The document header of the clinic',
                'example'     => '234234',
            ],
            'document_footer' => [
                'description' => 'The document footer of the clinic',
                'example'     => '234234',
            ],
        ];
    }
}
