<?php

namespace App\Mail;

use Twilio\Rest\Client;
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

    /**
     * Send SMS
     *
     * @param $to, $message
     * @return \Illuminate\Http\Response
     */
    public static function sendSms($to, $message)
    {
        // Your Account SID and Auth Token from twilio.com/console
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $client = new Client($sid, $token);

        // Use the client to do fun stuff like send text messages!
        $client->messages->create(
            // the number you'd like to send the message to
            $to,
            [
                // A Twilio phone number you purchased at twilio.com/console
                'from' => env('TWILIO_PHONE_NUMBER'),
                // the body of the text message you'd like to send
                'body' => $message,
            ]
        );
    }

    /**
     * Send SMS
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
