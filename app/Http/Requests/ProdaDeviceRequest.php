<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdaDeviceRequest extends FormRequest
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
            'device_name'   => 'required',
            'key_expiry'    => 'required|date',
            'device_expiry' => 'required|date',
            'clinic_id'     => 'required|numeric',
            'otac'          => '',
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
            'device_name' => [
                'description' => '',
                'example'     => '',
            ],
            'key_expiry' => [
                'description' => '',
                'example'     => '',
            ],
            'device_expiry' => [
                'description' => '',
                'example'     => '',
            ],
            'clinic_id' => [
                'description' => '',
                'example'     => '',
            ],
        ];
    }
}
