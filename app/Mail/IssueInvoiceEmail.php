<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;

class IssueInvoiceEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $appointment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $invoice = $this->appointment->generateInvoice();
        $invoice_number = generateInvoiceNumber($this->appointment->organization, $this->appointment);

        return $this->view('email.issueInvoice', [
                        'appointment'    => $this->appointment,
                        'invoice_number' => $invoice_number,
                    ])
                    ->subject("Invoice #{$invoice_number}")
                    ->attachData($invoice->output(), $invoice_number . '.pdf');
    }
}
