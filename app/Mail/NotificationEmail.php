<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function build()
    {
        $address = env('MAIL_FROM_ADDRESS');
        $name = env('MAIL_FROM_NAME');

        return $this->view('email')
            ->from($address, $name)
            ->subject($this->config['subject'])
            ->with(['message' => $this->config['message']]);
    }
}
