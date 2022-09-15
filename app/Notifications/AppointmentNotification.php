<?php

namespace App\Notifications;

use App\Models\Appointment;
use App\Models\NotificationTemplate;
use App\Models\Organization;
use Carbon\Carbon;

class AppointmentNotification
{
    public static function send($appointment, $type){

        $notificationTemplate =   $appointment->organization->notificationTemplates::where('type', $type)->first();
        $channel = $appointment->patient->appointment_confirm_method;
        $patient = $appointment->patient;
        $template = $channel == 'SMS' ? $notificationTemplate->sms_template : $notificationTemplate->email_print_template;
        $to = $channel == 'SMS' ?  $patient->int_contact_number :  $patient->email;

        $data = [
            'subject' => $notificationTemplate->subject,
            'message' => AppointmentNotification::translate($appointment, $template),
        ];

        if ($channel == 'SMS') {
            NotificationSms::sendSMS($to, $data['message']);
        } elseif ($channel == 'EMAIL') {
            NotificationEmail::sendEmail($to, $data['subject'], $data['message']);
        }
    }

    /**
     * translate template
     */
    public static function translate($appointment, $template){

        $preadmission_url = 'https://dev.aurorasw.com.au/#/appointment_pre_admissions/show/'
            . md5($appointment->id) . '/form_1';

        $confirm_url = 'https://dev.aurorasw.com.au/#/appointment/'
            . md5($appointment->id) . '/confirm';

        $words = [
            '[PatientFirstName]' => $appointment->patient->first_name,
            '[PatientLastName]'  => $appointment->patient->last_name,

            '[AppointmentTime]'     => $appointment->start_time,
            '[AppointmentFullDate]' => Carbon::create($appointment->date)->format('d/m/Y'),
            '[AppointmentDate]'     => Carbon::create($appointment->date)->format('jS, F'),
            '[AppointmentDay]'      => Carbon::create($appointment->date)->format('l'),

            '[AppointmentType]'     => $appointment->appointment_type->name,
            '[Specialist]'          => $appointment->specialist->full_name,

            '[ClinicName]'          => $appointment->clinic->name,
            '[ClinicPhone]'         => $appointment->clinic->phone_number,

            '[ClinicAddress]'       => $appointment->clinic->address,
            '[ClinicEmail]'         => $appointment->clinic->email,

            '[PreAdmissionURL]'     => $preadmission_url,
            '[ConfirmURL]'          => $confirm_url,
        ];

        $translated = $template;

        foreach ($words as $key => $word) {
            $translated = str_replace($key, $word, $translated);
        }

        return $translated;
    }

    public static function sendAppointmentConfirmNotifications() {
        $organizations = Organization::get();
        foreach ($organizations as $organization) {
            $template = $organization->notificationTemplates::where('type', 'appointment_confirmation')->first();
            $days_before = $template->days_before;
            $appointment_date = now()->addDays($days_before)->toDateString();

            $appointments = Appointment::where('organization_id', $organization->id)
                ->where('date', $appointment_date)
                ->get();

            foreach ($appointments as $appointment) {
                AppointmentNotification::send($appointment, 'appointment_confirmation');
            }
        }
    }

    public static function sendAppointmentReminderNotifications(){
        $organizations = Organization::get();
        foreach ($organizations as $organization) {
            $template = $organization->notificationTemplates::where('type', 'appointment_reminder')->first();
            $days_before = $template->days_before;
            $appointment_date = now()->addDays($days_before)->toDateString();

            $appointments = Appointment::where('organization_id', $organization->id)
                ->where('date', $appointment_date)
                ->get();

            foreach ($appointments as $appointment) {
                AppointmentNotification::send($appointment, 'appointment_reminder');
            }
        }
    }
}
