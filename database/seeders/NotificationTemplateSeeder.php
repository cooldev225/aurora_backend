<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NotificationTemplate;
use App\Models\Organization;

class NotificationTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organizations = Organization::all();

        foreach ($organizations as $organization) {
            NotificationTemplate::create([
                'organization_id'   => $organization->id,
                'type'              => 'appointment_booked',
                'title'             => 'Appointment Booked',
                'days_before'       => 0,
                'subject'           => 'Appointment Booked',
                'sms_template'      =>
                    "Hello [PatientFirstName], You just booked in at [Time] at [ClinicName] on the [Date]",
                'email_print_template' =>
                    "Hello [PatientFirstName], You just booked in at [Time] at [ClinicName] on the [Date]",
                    'description' => 'This notification is sent to the patient as soon as the appointment is created. It will include a link to any relevant pre-admission forms.',
            ]);

            NotificationTemplate::create([
                'organization_id'   => $organization->id,
                'type'              => 'appointment_confirmation',
                'title'             => 'Appointment Confirmation',
                'days_before'       => 3,
                'subject'           => 'Appointment Confirmation',
                'sms_template'      =>
                    "Hello [PatientFirstName], you're booked in at [Time] at [ClinicName] on the [Date]. "
                    . "Please reply 'Yes' to confirm or call [ClinicNumber] to cancel or reschedule.",
                'email_print_template' =>
                    "Hello [PatientFirstName], you're booked in at [Time] at [ClinicName] on the [Date]. "
                    . "Please reply 'Yes' to confirm or call [ClinicNumber] to cancel or reschedule.",
                    'description' => 'This notification is sent to the patient x days prior to their appointment. This will include a link for the patient to confirm their appointment.',
            ]);

            NotificationTemplate::create([
                'organization_id'   => $organization->id,
                'type'              => 'appointment_reminder',
                'title'             => 'Appointment Reminder',
                'days_before'       => 3,
                'subject'           => 'Appointment Reminder',
                'sms_template'      =>
                    "Hello [PatientFirstName], There is your appointment in at [Time] at [ClinicName] on the [Date]",
                'email_print_template' =>
                    "Hello [PatientFirstName], There is your appointment in at [Time] at [ClinicName] on the [Date]",
                    'description' => 'This notification is sent to the patient x days prior to their appointment to remind them about their up coming appointment.',
            ]);

            NotificationTemplate::create([
                'organization_id'   => $organization->id,
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
        }
    }
}
