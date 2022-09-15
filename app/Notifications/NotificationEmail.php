<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

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

        return $this->markdown('email.translated')
            ->from($address, $name)
            ->subject($this->config['subject'])
            ->with(['message' => $this->config['message']]);
    }


    /**
     * Send Email
     *
     * @param $to, $subject, $message
     * @return \Illuminate\Http\Response
     */
    public static function sendEmail($to, $subject, $message)
    {
        Mail::to($to)->send(
            new NotificationEmail([
                'subject' => $subject,
                'message' => $message,
            ])
        );
    }
}
