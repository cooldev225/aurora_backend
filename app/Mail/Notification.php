<?php

namespace App\Mail;

use App\Models\NotificationTemplate;

class Notification
{
    public static function sendAppointmentBooked($appointment) {
        $patient = $appointment->patient();
        $notificationTemplate =  NotificationTemplate::where('type', 'appointment_booked')
            ->where('organization_id', $appointment->organization_id)
            ->first();

        if ($patient->preferred_contact_method == 'sms') {

            $template = $notificationTemplate->sms_template;
            $to = $patient->contact_number;
            $message = $appointment->translate($template);

            // NotificationEmail::sendSMS($to, $message);

        } else if ($patient->preferred_contact_method == 'email') {
            
            $template = $notificationTemplate->email_print_template;
            $to = $patient->email;
            $subject = $notificationTemplate->subject;
            $message = $appointment->translate($template);

            // NotificationEmail::sendEmail($to, $subject, $message);

        } else {
            return;
        }
    }
}
