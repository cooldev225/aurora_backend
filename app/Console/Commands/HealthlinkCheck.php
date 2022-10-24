<?php

namespace App\Console\Commands;


use App\Models\Patient;
use App\Models\PatientDocument;
use App\Models\SpecialistClinicRelation;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Aranyasen\HL7\Message;
use Carbon\Carbon;

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
        $newMessages =  Storage::disk('healthlink')->files('HL7_in');

        foreach ($newMessages as $message) {
            $HL7messageRaw = Storage::disk('healthlink')->get($message);

            $msg = new Message($HL7messageRaw);
            $msh = $msg->getSegmentsByName("MSH")[0];
            $messageType = $msh->getField(9)[0];
            if ($messageType == "REF") {
                $data = parseHeathLinkHL7RefMessage($msg);
            } else {
                $data =  parseHeathLinkHL7OruMessage($msg);
            }

            $specialist = null; //Receiving Specialist
            
            foreach ($data['prds'] as $key => $value) {
                if($value['provider_role'] == 'RT'){
                    $providerNum = SpecialistClinicRelation::where('provider_number',$value['provider_number'])->first();
                    $specialist = $providerNum ? User::where('id', $providerNum->specialist_id)->first() : null; 
                    echo $specialist->full_name;
                }else if ($value['provider_role'] == 'RP'){
                    //echo 'Sending Provider Number: '. $value['provider_number'];
                }
            }
            die();

            // ATTEMPT ASSIGN SPECIALIST
            $specialist = User::where('username', 'specialist')->first();
            $organization_id = $specialist->organization_id;

            if ($specialist) {

                // ATTEMPT ASSIGN PATIENT
                $patient = Patient::where('first_name',  $data['pid']['patient_first_name'])
                    ->where('last_name',  $data['pid']['patient_last_name'])
                    ->where('date_of_birth',  Carbon::parse($data['pid']['patient_dob'])->format('Y-m-d'));

                $patient_id =   $patient->count() == 1 ?  $patient->first()->id : null;

                PatientDocument::create([
                    'organization_id'   => $organization_id,
                    'patient_id'        => $patient_id,
                    'specialist_id'     =>  $specialist->id,
                    'document_name'     => 'TBD',
                    'document_type'     => 'OTHER',
                    'file_type'         => 'HTML',
                    'document_body'     => $data['document_contents'],
                    'origin'            => 'RECEIVED',
                    'is_seen'           => 0,
                    'created_by'        => 0,

                ]);

                // SEND ACK
                $HL7messageRaw = Storage::disk('healthlink')->delete($message);
            } else {

                echo 'NO SPECIALIST FOUND';

            }





        
          
            //Send ACK
        }
    }
}
