<?php

namespace App\Console\Commands;

use App\Models\PatientRecall;
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
        $patients_recalls = PatientRecall::where(
            'recall_date',
            date('Y-m-d')
        )->get();

        foreach ($patients_recalls as $patients_recall) {
            $patients_recall->sendRecall();
        }

        $this->info('Successfully sent Recall Messages');
    }
}
