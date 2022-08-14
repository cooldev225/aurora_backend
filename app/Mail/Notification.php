<?php

namespace App\Mail;

use App\Models\NotificationTemplate;
use App\Models\PatientRecall;
use Illuminate\Support\Facades\Log;

class Notification
{
    public static function sendAppointmentNotification(
        $appointment,
        $notificationType,
        $notificationTemplate = null
    ) {
        $patient = $appointment->patient();
        if ($notificationTemplate == null) {
            $notificationTemplate =  NotificationTemplate::where('type', $notificationType)
                ->where('organization_id', $appointment->organization_id)
                ->first();
        }

        if ($patient->appointment_confirm_method == 'sms') {

            $template = $notificationTemplate->sms_template;
            $data = [
                'to'        => $patient->int_contact_number,
                'message'   => $appointment->translate($template),
            ];
            self::sendNotification('sms', $data);

        } else if ($patient->appointment_confirm_method == 'email') {
            
            $template = $notificationTemplate->email_print_template;
            $data = [
                'to'        => $patient->int_contact_number,
                'subject'   => $notificationTemplate->subject,
                'message'   => $appointment->translate($template),
            ];
            self::sendNotification('email', $data);

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
            $data = [
                'to'        => $patient_recall->contact_number,
                'message'   => PatientRecall::translate($template, $patient_recall),
            ];
            self::sendNotification('sms', $data);

        } else if ($patient_recall->send_recall_method == 'email') {
            
            $template = $notificationTemplate->email_print_template;
            $data = [
                'to'        => $patient_recall->email,
                'subject'   => $notificationTemplate->subject,
                'message'   => PatientRecall::translate($template, $patient_recall),
            ];
            self::sendNotification('email', $data);

        } else {
            return;
        }
    }

    public static function sendUserNotification($data, $user, $notificationType) {
        $notificationTemplate =  NotificationTemplate::where('type', $notificationType)
            ->where('organization_id', $data['organization_id'])
            ->first();
            
        $template = $notificationTemplate->email_print_template;
        $data = [
            'to'        => $user->email,
            'subject'   => $notificationTemplate->subject,
            'message'   => $user->translate($template, $data),
        ];
        self::sendNotification('email', $data);
    }
    
    public static function sendPaymentNotification(
        $payment,
        $notificationType
    ) {
        $appointment = $payment->appointment;
        $patient = $appointment->patient();

        $notificationTemplate =  NotificationTemplate::where('type', $notificationType)
            ->where('organization_id', $appointment->organization_id)
            ->first();

        if ($patient->appointment_confirm_method == 'sms') {

            $template = $notificationTemplate->sms_template;
            $data = [
                'to'        => $patient->int_contact_number,
                'message'   => $payment->translate($template),
            ];
            self::sendNotification('sms', $data);

        } else if ($patient->appointment_confirm_method == 'email') {
            
            $template = $notificationTemplate->email_print_template;
            $data = [
                'to'        => $patient->int_contact_number,
                'subject'   => $payment->translate($notificationTemplate->subject),
                'message'   => $payment->translate($template),
            ];
            self::sendNotification('email', $data);

        } else {
            return;
        }
    }

    

    private static function sendNotification($notification_type, $data) {
        if ($notification_type == 'sms') {

            $to = $data['to'];
            $message = $data['message'];
            
            if (env('SEND_NOTIFICATION') == true) {
                NotificationEmail::sendSMS($to, $message);
            } else {
                Log::info("To: " . $to . "\r\n");
                Log::info("Message: " . $message . "\r\n");
            }
            
        } else if ($notification_type == 'email') {

            $to = $data['to'];
            $subject = $data['subject'];
            $message = $data['message'];

            if (env('SEND_NOTIFICATION') == true) {
                NotificationEmail::sendEmail($to, $subject, $message);
            } else {
                Log::info("To: " . $to . "\r\n");
                Log::info("Subject: " . $subject . "\r\n");
                Log::info("Message: " . $message . "\r\n");
            }
        }

    }
}
