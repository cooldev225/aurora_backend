<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Models\Organization;
use Illuminate\Console\Command;

class AppointmentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointment:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->sendAppointmentReminderNotifications();

        $this->info('Successfully sent Appointment Confirm');
    }

    private function sendAppointmentReminderNotifications(){
        $organizations = Organization::get();
        foreach ($organizations as $organization) {
            $template = $organization->notificationTemplates->where('type', 'appointment_reminder')->first();
            $days_before = $template->days_before;
            $appointment_date = now()->addDays($days_before)->toDateString();

            $appointments = Appointment::where('organization_id', $organization->id)
                ->where('date', $appointment_date)
                ->get();

            foreach ($appointments as $appointment) {
                $appointment->sendNotification('appointment_reminder');
            }
        }
    }
}
