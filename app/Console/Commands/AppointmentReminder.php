<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Notifications\AppointmentNotification;
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
        AppointmentNotification::sendAppointmentReminderNotifications();

        $this->info('Successfully sent Appointment Confirm');
    }
}
