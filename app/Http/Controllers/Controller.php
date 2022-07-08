<?php

namespace App\Http\Controllers;

use App\Mail\NotificationEmail;
use Twilio\Rest\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Send SMS
     *
     * @param $to, $message
     * @return \Illuminate\Http\Response
     */
    public function sendSms($to, $message)
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
    public function sendEmail($to, $subject, $message)
    {
        $data = ['subject' => $subject, 'message' => $message];

        Mail::to($to)->send(new NotificationEmail($data));
    }
}
