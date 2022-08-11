<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'type',
        'title',
        'days_before',
        'subject',
        'sms_template',
        'email_print_template',
        'status',
    ];

    public static function CreateOrganizationNotification($organization) {
        $organization_id = $organization->id;
        
        NotificationTemplate::create([
            'organization_id'   => $organization_id,
            'type'              => 'appointment_booked',
            'title'             => 'Appointment Booked',
            'days_before'       => 0,
            'allow_day_edit'    => false,
            'subject'           => 'Appointment Booked',
            'sms_template'      =>
                "Hello [PatientFirstName], You just booked in at [AppointmentTime] at [ClinicName] on the [AppointmentDate]. "
                . "Please submit preadmission here [PreAdmissionURL]",
            'email_print_template' =>
                "Hello [PatientFirstName], You just booked in at [AppointmentTime] at [ClinicName] on the [AppointmentDate]. "
                . "Please submit preadmission here [PreAdmissionURL]",
                'description' => 'This notification is sent to the patient as soon as the appointment is created. It will include a link to any relevant pre-admission forms.',
        ]);

        NotificationTemplate::create([
            'organization_id'   => $organization_id,
            'type'              => 'appointment_confirmation',
            'title'             => 'Appointment Confirmation',
            'days_before'       => 3,
            'subject'           => 'Appointment Confirmation',
            'sms_template'      =>
                "Hello [PatientFirstName], you're booked in at [AppointmentTime] at [ClinicName] on the [AppointmentDate]. "
                . "Please reply 'Yes' to confirm or call [ClinicPhone] to cancel or reschedule.",
            'email_print_template' =>
                "Hello [PatientFirstName], you're booked in at [AppointmentTime] at [ClinicName] on the [AppointmentDate]. "
                . "Please reply 'Yes' to confirm or call [ClinicPhone] to cancel or reschedule.",
                'description' => 'This notification is sent to the patient x days prior to their appointment. This will include a link for the patient to confirm their appointment.',
        ]);

        NotificationTemplate::create([
            'organization_id'   => $organization_id,
            'type'              => 'appointment_reminder',
            'title'             => 'Appointment Reminder',
            'days_before'       => 3,
            'subject'           => 'Appointment Reminder',
            'sms_template'      =>
                "Hello [PatientFirstName], There is your appointment in at [AppointmentTime] at [ClinicName] on the [AppointmentDate]",
            'email_print_template' =>
                "Hello [PatientFirstName], There is your appointment in at [AppointmentTime] at [ClinicName] on the [AppointmentDate]",
                'description' => 'This notification is sent to the patient x days prior to their appointment to remind them about their up coming appointment.',
        ]);

        NotificationTemplate::create([
            'organization_id'   => $organization_id,
            'type'              => 'recall',
            'title'             => 'Recall',
            'days_before'       => 3,
            'subject'           => 'Recall Notification',
            'sms_template'      =>
                "Hello [PatientFirstName], Please contact clinic x on 03 5933 4857 to book an appointment",
            'email_print_template' =>
                "Hello [PatientFirstName], Please contact clinic x on 03 5933 4857 to book an appointment",
                'description' => 'This notification is sent to the patient x days prior to their recall date to remind them about the recall.',
        ]);

        NotificationTemplate::create([
            'organization_id'   => $organization_id,
            'type'              => 'procedure_denied',
            'title'             => 'Procedure Denied',
            'days_before'       =>  0,
            'allow_day_edit'    => false,
            'subject'           => 'Procedure Denied',
            'sms_template'      =>
                "Hello [PatientFirstName], I am sorry but your procedure has been denied. Please contact clinic on 03 5933 4857 to discuss",
            'email_print_template' =>
            "Hello [PatientFirstName], I am sorry but your procedure has been denied. Please contact clinic on 03 5933 4857 to discuss",
                'description' => 'This notification is sent to the patient when the anesthetist denied their procedure.',
        ]);

        NotificationTemplate::create([
            'organization_id'   => $organization_id,
            'type'              => 'procedure_approved',
            'title'             => 'Procedure Approved',
            'days_before'       =>  0,
            'allow_day_edit'    => false,
            'subject'           => 'Procedure Approved',
            'sms_template'      =>
                "Hello [PatientFirstName], Your procedure has been approved.Please follow the link below to view your pre-procedure instructions.",
            'email_print_template' =>
            "Hello [PatientFirstName], our procedure has been approved.Please follow the link below to view your pre-procedure instructions.",
            'description' => 'This notification is sent to the patient when the anesthetist approved their procedure.',
        ]);

    }
}
