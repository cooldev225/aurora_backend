<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\PatientDocument;
use App\Notifications\AppointmentNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Aranyasen\HL7\Message; 

class HealthlinkCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'healthlink:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'checks the healthlink server for incoming communication';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Checking HealthLink Server");
    
      
        $newMessages =  Storage::disk('healthlink')->files('HL7_in');
        //Turn into a queue
        foreach ($newMessages as $message) {
            $HL7messageRaw = Storage::disk('healthlink')->get($message);        
            //$HL7data = getDataFromHL7($HL7messageRaw);
           // echo $HL7messageRaw;
            echo $HL7messageRaw;
  /*
            // Match the location up with their EDI to ensure correct patient and specialsit are.

            //Set org using the above
            $organization_id = 1;

            //Set the patient for the document
            $patient = Patient::
            where('first_name',$HL7data['patient_first_name'])
            ->where('last_name',$HL7data['patient_last_name'])
            ->where('date_of_birth', $HL7data['patient_date_of_birth'])
            ->first();
            $patient_id = $patient ? $patient->id : null;

        
            //Set the Specialist for the document
           $specialist_id = null;
           
            $documentBody = formatHL7BodyToHTML($HL7data['data_content']);

            $this->info($documentBody );
           PatientDocument::create([
            'organization_id'   => $organization_id,
            'patient_id'        => $patient_id,
            'specialist_id'     => $specialist_id,
            'document_name'     => 'TBD',
            'document_type'     => 'OTHER',
            'file_type'         => 'HTML',
            'document_body'     => $documentBody,
            'origin'            => 'RECEIVED',
            'is_seen'           => 0,
            'created_by'        => 0,

           ]);
            //Send ACK
            //Parse from HL7 to PAtientDocument
            //Remove from health server if required
            //store file in db incase issue
            */
        }

        
    }
}
