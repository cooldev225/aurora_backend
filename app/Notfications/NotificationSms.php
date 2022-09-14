<?php

namespace App\Notifications;

use Twilio\Rest\Client;

class NotificationSms
{

    /**
     * Send SMS
     *
     * @param $to, $message
     * @return \Illuminate\Http\Response
     */
    public static function sendSMS($to, $message)
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
}
