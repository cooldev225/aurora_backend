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
    protected $reissue;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(AppointmentPayment $payment, bool $reissue)
    {
        $this->payment = $payment;
        $this->reissue = $reissue;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $invoice = $this->payment->generateInvoice();
        $subject = $this->reissue ? 'Copy of Your Payment Confirmation' : 'Payment Confirmation';

        return $this->view('email.paymentConfirmation', [
                        'payment' => $this->payment,
                    ])
                    ->subject($subject)
                    ->attachData($invoice->output(), $this->payment->full_invoice_number . '.pdf');
    }
}
