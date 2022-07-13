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
        PatientRecall::sendCurrentRecalls();

        $this->info('Successfully sent Recall Messages');
    }
}
