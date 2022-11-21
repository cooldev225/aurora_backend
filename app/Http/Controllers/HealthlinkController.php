<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\OutgoingMessageLog;
use App\Models\Patient;
use App\Models\PatientDocument;
use App\Models\DoctorAddressBook;
use App\Models\SpecialistClinicRelation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Aranyasen\HL7\Message;
use Aranyasen\HL7\Segment; // If Segment is used
use Aranyasen\HL7\Segments\MSH;
use Aranyasen\HL7\Segments\PID;
use Aranyasen\HL7\Segments\RF1;
use Aranyasen\HL7\Segments\OBR;
use Aranyasen\HL7\Segments\OBX;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\HealthLinkStoreRequest;
use App\Enum\OutMessageSendMethod;

class HealthLinkController extends Controller
{

    public function store(HealthLinkStoreRequest $request){
        $receivingDoctor = DoctorAddressBook::find($request->receiving_doctor_id);
        $documentToSend = PatientDocument::find($request->patient_document_id);

        $patient = $documentToSend->patient;
        $specialist = $documentToSend->specialist;
        $appointment = $documentToSend->appointment;
        $sending_provider_number = SpecialistClinicRelation::
            where('specialist_id', $specialist->id)
            ->where('clinic_id', $appointment->clinic_id)
            ->first();

        OutgoingMessageLog::create([
            'send_method'                   => OutMessageSendMethod::HEALTHLINK,
            'sending_doctor_name'           => $specialist->full_name,
            'sending_doctor_provider'       => $sending_provider_number,
            'receiving_doctor_name'         => $receivingDoctor->full_name,
            'receiving_doctor_provider'     => $receivingDoctor->provider_no,
            'organization_id'               => $documentToSend->organization_id,
            'patient_id'                    => $patient->id,
            'sending_doctor_user'           => $specialist->id,
            'sending_user'                  => $patient->id,
            'receiving_doctor_name'         => $receivingDoctor->first_name . ' ' . $receivingDoctor->last_name,
            'patient_id'                    => $patient->id,
            'patient_id'                    => $patient->id,
            'patient_id'                    => $patient->id,
            'patient_id'                    => $patient->id,
            'patient_id'                    => $patient->id,
        ]);

        /* Remove for testing
        $msg = new Message();

        // MSH Header Segment
        $msh = new MSH();
        $msh->setField(3, env('APP_NAME') . "V". env('APP_VERSION')); //SENDING APPLICATION
        $msh->setField(4, 'SENDING_FACILITY'); // SENDING FACILITY (Aurora edi)
        $msh->setField(5,'RECEIVING_APPLICATION'); // RECEIVING APPLICATION
        $msh->SetField(6,'RECEIVING_FACILITY');// RECEIVING FACILITY
        $msh->SetField(9,'REF^I12');// MESSAGE TYPE
        $msh->SetField(10, $log->id );// UNIQUE MESSAGE ID GENERATED BY SYSTEM
        $msh->SetField(11, 'D'); //P - process as normal,  D - debugging, T - training
        $msh->SetField(12, '2.3.1'); //HL7 version ID
        $msg->addSegment($msh);

        // RF1 Referral Segment
        $rf1 = new Segment('RF1');
        $rf1->setField(1, 'P'); // Referral Status P - pending, A - Accepted, R - rejected, E - expired
        $rf1->setField(2, 'R'); // Referral Priority R - Routine, S - STAT, A - ASAP
        $rf1->setField(3, 'MED'); // Referral Type - PG 22 healthlink ref guide table
        $rf1->setField(4, 'WR'); // Referral Disposition - PG 22 healthlink ref guide table
        $rf1->setField(6, 'AUR' . $log->id); // Original Referral ID
        $rf1->setField(10, 'E'); //Referral reason - PG 23 healthlink ref guide table
        $rf1->setField(11, '000');// Referrer ID
        $msg->addSegment($rf1);

        //PRD 1 Sending Doctor
        $prd1 = new Segment('PRD');
        $prd1->setField(1,'RP'); // PROVIDER ROLE RP - Referring prov, PT - refereed to
        $prd1->setField(2,'sendLastname^Firstname^^^DR'); // XPN NAME: FAMILY^GIVEN^SECOND AND OTET^SUFFIX^PREFIX^DEGREE ....
        $prd1->setField(7, 'SEND_PROVIDER^PROV#'); // Provider ID Id^ProviderType
        $msg->addSegment($prd1);

        //PRD 1 Receiving Doctor
        $prd2 = new Segment('PRD');
        $prd2->setField(1,'RT');
        $prd2->setField(2,'RecLastname^Firstname^^^DR');
        $prd2->setField(7, 'REC_PROVIDER^PROV#');
        $msg->addSegment($prd2);


        // PID Patient Info
        $pid = new Segment('PID');
        $pid->setField(1, $patient->id);
        $pid->setField(5, $patient->last_name . '^' . $patient->first_name);
        $pid->setField(7, Carbon::parse($patient->date_of_birth)->format('Ymd'));
        $pid->setField(8, $patient->sex_format_hl7);
        $pid->setField(9, $patient->race);
        $msg->addSegment($pid);

        // OBR Observation Request Segment
        $obr = new OBR();
        $obr->setField(4, $appointment->id);
        $msg->addSegment($obr);

        // OBX Observation Result Segment
        $obx = new OBX();
        $obx->setValueType('ED');
        $obx->setField(3 , 'PDF^Display format in PDF^AUSPDI');

        $testDoc = PatientDocument::find(4);
        $file = Storage::disk('local')->get("files/1/". $testDoc->file_path);
        $pdf64 =  chunk_split(base64_encode($file));

        $obx->setField(5 ,'^TX^PDF^Base64^'. str_replace("\r\n",'', $pdf64));
        $msg->addSegment($obx);

        Storage::put('public/testHL7/1 (40).hl7', str_replace('\n',"\r\n",$msg->toString()));

        return $msg->toString();

         */

        return response()->json(
            [
                'message' => 'Healthlink Message Sent',
                'data'    => null,
            ],
            Response::HTTP_OK
        );
    }
}
