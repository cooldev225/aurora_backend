<?php

namespace App\Mail;

use App\Models\NotificationTemplate;
use App\Models\PatientRecall;

class Notification
{
    public static function sendAppointmentBooked($appointment) {
        $patient = $appointment->patient();
        $notificationTemplate =  NotificationTemplate::where('type', 'appointment_booked')
            ->where('organization_id', $appointment->organization_id)
            ->first();

        if ($patient->appointment_confirm_method == 'sms') {

            $template = $notificationTemplate->sms_template;
            $to = $patient->contact_number;
            $message = $appointment->translate($template);

            if (env('SEND_NOTIFICATION') == true) {
                NotificationEmail::sendSMS($to, $message);
            }

        } else if ($patient->appointment_confirm_method == 'email') {
            
            $template = $notificationTemplate->email_print_template;
            $to = $patient->email;
            $subject = $notificationTemplate->subject;
            $message = $appointment->translate($template);

            if (env('SEND_NOTIFICATION') == true) {
                NotificationEmail::sendEmail($to, $subject, $message);
            }

        } else {
            return;
        }
    }

    public static function sendRecall($patient_recall) {
        $notificationTemplate =  NotificationTemplate::where('type', 'recall')
            ->where('organization_id', $patient_recall->organization_id)
            ->first();

        if ($patient_recall->send_recall_method == 'sms') {

            $template = $notificationTemplate->sms_template;
            $to = $patient_recall->contact_number;
            $message = PatientRecall::translate($template, $patient_recall);

            // NotificationEmail::sendSMS($to, $message);

        } else if ($patient_recall->send_recall_method == 'email') {
            
            $template = $notificationTemplate->email_print_template;
            $to = $patient_recall->email;
            $subject = $notificationTemplate->subject;
            $message = PatientRecall::translate($template, $patient_recall);

            // NotificationEmail::sendEmail($to, $subject, $message);

        } else {
            return;
        }
    }
}
