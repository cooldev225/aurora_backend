<?php

namespace App\Console\Commands;

use App\Models\Organization;
use App\Models\PatientRecall;
use App\Models\PatientRecallSentLog;
use App\Notifications\RecallNotification;
use Illuminate\Console\Command;

class PatientRecallScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'patient:recall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Recall message to patient';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->sendCurrentRecalls();

        $this->info('Successfully sent Recall Messages');
    }


    
    /**
     * Send Recall Message to Patient
     */
    private function sendCurrentRecalls()
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
                $recall->sendNotification();

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
