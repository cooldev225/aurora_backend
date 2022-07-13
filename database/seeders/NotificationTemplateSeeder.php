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
            ]);
        }
    }
}
