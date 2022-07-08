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
                'organization_id' => $organization->id,
                'days_before' => 3,
                'subject' => 'Recall Notification',
                'sms_template' =>
                    "Hello [PatientFirstName], you're booked in at [Time] at [ClinicName] on the [Date]",
                'email_print_template' =>
                    "Hello [PatientFirstName], you're booked in at [Time] at [ClinicName] on the [Date]",
            ]);
        }
    }
}
