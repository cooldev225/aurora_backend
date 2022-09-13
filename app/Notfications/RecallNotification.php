<?php

namespace App\Notifications;

use App\Models\NotificationTemplate;
use App\Models\Organization;
use App\Models\PatientRecall;
use App\Models\PatientRecallSentLog;

class RecallNotification
{

    public static function send($patient_recall)
    {
        $channel = $patient_recall->patient->appointment_confirm_method;
        $to = $channel == 'SMS' ?  $patient_recall->int_contact_number :  $patient_recall->email;

        $notificationTemplate = NotificationTemplate::where('type', 'recall')
            ->where('organization_id', $patient_recall->organization_id)
            ->first();

        $template = $channel == 'SMS' ? $notificationTemplate->sms_template : $notificationTemplate->email_print_template;

        $data = [
            'subject' => $notificationTemplate->subject,
            'message' => RecallNotification::translate(
                $patient_recall,
                $template,
            ),
        ];

        if ($channel == 'SMS') {
            NotificationSms::sendSMS($to, $data['message']);
        } elseif ($channel == 'EMAIL') {
            NotificationEmail::sendEmail($to, $data['subject'], $data['message']);
        }
    }

    public static function translate($patient_recall, $template,) {
        $words = [
            '[PatientFirstName]'    => $patient_recall->first_name,
        ];

        $translated = $template;

        foreach ($words as $key => $word) {
            $translated = str_replace($key, $word, $translated);
        }

        return $translated;
    }

    /**
     * Send Recall Message to Patient
     */
    public static function sendCurrentRecalls()
    {
        $organizations = Organization::get();
        foreach ($organizations as $organization) {
            $template = $organization->notificationTemplates::where('type', 'recall')->first();
            
            $days_before = $template->days_before;
            $date = now()->addDays($days_before)->toDateString();

            $recalls = PatientRecall::where('organization_id', $organization->id)
                ->where('date_recall_due', $date)
                ->with('patient')
                ->get();

            foreach ($recalls as $recall) {
                RecallNotification::send($recall);

                $recall->confirmed = true;
                $recall->save();
    
                $patient_recall_sent_log = new PatientRecallSentLog();
                $patient_recall_sent_log->patient_recall_id = $recall->id;
                $patient_recall_sent_log->recall_sent_at = date('Y-m-d H:i:s');
                $patient_recall_sent_log->sent_by = $recall->patient->appointment_confirm_method;
                $patient_recall_sent_log->save();
            }
        }
  
 
    }


}
