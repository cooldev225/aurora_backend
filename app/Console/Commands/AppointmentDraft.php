<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AppointmentDraft extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointment:draft';

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
        $this->deleteDraftAppointments();
        $this->info('Successfully delete draft appointments');
    }

    private function deleteDraftAppointments()
    {
        Appointment::where('draft_status', true)
            ->where('created_at', '<', now()->subMinutes(10))->delete();
    }
}
