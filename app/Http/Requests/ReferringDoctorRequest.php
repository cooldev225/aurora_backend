<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReferringDoctorRequest extends FormRequest
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
            'provider_no' => [
                'description' => '',
                'example'     => '',
            ],
            'title' => [
                'description' => '',
                'example'     => '',
            ],
            'first_name' => [
                'description' => '',
                'example'     => '',
            ],
            'last_name' => [
                'description' => '',
                'example'     => '',
            ],
            'address' => [
                'description' => '',
                'example'     => '',
            ],
            'street' => [
                'description' => '',
                'example'     => '',
            ],
            'city' => [
                'description' => '',
                'example'     => '',
            ],
            'state' => [
                'description' => '',
                'example'     => '',
            ],
            'country' => [
                'description' => '',
                'example'     => '',
            ],
            'postcode' => [
                'description' => '',
                'example'     => '',
            ],
            'phone' => [
                'description' => '',
                'example'     => '',
            ],
            'fax' => [
                'description' => '',
                'example'     => '',
            ],
            'mobile' => [
                'description' => '',
                'example'     => '',
            ],
            'email' => [
                'description' => '',
                'example'     => '',
            ],
            'practice_name' => [
                'description' => '',
                'example'     => '',
            ],
        ];
    }
}
