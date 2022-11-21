<?php

namespace App\Mail;

use App\Models\AppointmentPayment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PaymentConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $payment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(AppointmentPayment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $invoice = $this->payment->generateInvoice();

        return $this->view('email.paymentConfirmation', [
                        'payment' => $this->payment,
                    ])
                    ->subject('Payment Confirmation')
                    ->attachData($invoice->output(), $this->payment->full_invoice_number . '.pdf');
    }
}
