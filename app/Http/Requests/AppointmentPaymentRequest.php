<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentPaymentRequest extends FormRequest
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
            'appointment_id'    => 'required|integer',
            'amount'            => 'required|numeric',
            'payment_type'      => 'required|string',
            'is_deposit'        => 'required|boolean',
            'is_send_receipt'   => '',
            'email'             => '',
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
            'appointment_id' => [
                'description' => '',
                'example'     => '',
            ],
            'amount' => [
                'description' => '',
                'example'     => '',
            ],
            'payment_type' => [
                'description' => '',
                'example'     => '',
            ],
            'is_deposit' => [
                'description' => '',
                'example'     => '',
            ],
        ];
    }
}
