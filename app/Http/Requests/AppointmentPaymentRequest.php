<?php

namespace App\Http\Requests;

use App\Enum\NotificationMethod;
use App\Enum\PaymentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

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
            'appointment_id'      => 'required|integer|exists:appointments,id',
            'amount'              => 'required|numeric',
            'payment_type'        => ['required', new Enum(PaymentType::class)],
            'is_deposit'          => 'required|boolean',
            'is_send_receipt'     => 'required|boolean',
            'notification_method' => ['required_id:is_send_receipt,true', new Enum(NotificationMethod::class)],
            'sent_to'             => 'required_if:is_send_receipt,true|nullable|email',
        ];
    }
}
