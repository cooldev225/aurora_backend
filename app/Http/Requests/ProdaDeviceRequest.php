<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam device_name     string   required   The name of the proda device                      Example: My Device
* @bodyParam key_expiry      date     required   The expiry date of the key for the proda device   Example: 2022-09-01
* @bodyParam device_expiry   date     required   The expiry date of the proda device               Example: 2022-09-01
* @bodyParam clinic_id       int      required   The clinic where the proda device is kept         Example: 1
* @bodyParam otac            int      required   The OTAC for the proda device                     Example:
*/
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
            'clinic_id'     => 'required|numeric|exists:clinics,id',
            'otac'          => 'required|numeric',
        ];
    }
}
