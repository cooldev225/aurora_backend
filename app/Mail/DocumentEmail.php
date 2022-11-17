<?php

namespace App\Mail;

use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class DocumentEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $document;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.sample')
                    ->subject("Sample Email");
    }
}
