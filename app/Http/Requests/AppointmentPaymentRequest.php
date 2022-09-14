<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @bodyParam appointment_id    string  required  The ID of the associated appointment                                     Example: 1
* @bodyParam amount            enum    required  The amount to be paid (in cents)                                         Example: 12345
* @bodyParam payment_type      string  required  The type of payment being made                                           Example: 
* @bodyParam is_deposit        bool    required  Whether the payment is a deposit or not                                  Example: true
* @bodyParam is_send_receipt   bool    required  Whether a receipt should be sent                                         Example: true
* @bodyParam email             string            The email to send the receipt to (required if is_send_receipt is true)
*/
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
            'appointment_id'    => 'required|integer|exists:appointments',
            'amount'            => 'required|numeric',
            'payment_type'      => 'required|string',
            'is_deposit'        => 'required|boolean',
            'is_send_receipt'   => 'required|boolean',
            'email'             => 'required_if:is_send_receipt,true|email',
        ];
    }
}
