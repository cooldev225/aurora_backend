<?php

namespace App\Notifications;

use App\Models\AppointmentPayment;
use Carbon\Carbon;

class PaymentConfirmationNotification
{
    private static $method = 'email';

    public static function send($to, AppointmentPayment $appointment_payment)
    {
        $appointment = $appointment_payment->appointment;
        $appointment_date = Carbon::create($appointment->date)->format('j M Y');
        $patient = $appointment->patient;

        $amount = $appointment_payment->amount * 100;

        $subject = "Payment receipt for your {$appointment_date} appointment";
        $message = "Hello {$patient->first_name}, Your ${$amount} payment for your {$appointment_date} appointment at {$appointment->clinic->name} has been received.
                    If you have any questions or queries, please contact the clinic on {$appointment->clinic->phone_number}";

        switch (self::$method) {
            case 'email':
                NotificationEmail::sendEmail($to, $subject, $message);
            case 'sms':
                NotificationSms::sendsms($to, $message);
        }
    }

    public static function email() {
        self::$method = 'email';

        return new self;
    }

    public static function sms() {
        self::$method = 'sms';

        return new self;
    }

    public static function method($method) {
        self::$method = $method;

        return new self;
    }
}
