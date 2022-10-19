<?php

namespace App\Http\Controllers;

use App\Models\PatientDocument;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Aranyasen\HL7\Message; 
use Aranyasen\HL7\Segment; // If Segment is used
use Aranyasen\HL7\Segments\MSH; 
use Aranyasen\HL7\Segments\PID; 
use Aranyasen\HL7\Segments\OBR; 
use Aranyasen\HL7\Segments\OBX;
use Illuminate\Support\Facades\Storage;

class HL7TestController extends Controller
{

    public function testHL7Parse(Request $request)
    {

        $testHL7Content = '';
        $fileNo = $request->file_num ? $request->file_num : rand(1, 21);
        $filename = "storage/testHL7/1 (" . $fileNo . ").hl7";
        $file = file($filename);
        foreach ($file as $line) {
            $testHL7Content .= $line;
        }

     
        return view('hl7ParsingV2', $this->parseHeathLinkHL7message($testHL7Content, $filename));
    }


    public function parseHeathLinkHL7message($message, $filename = ""){


        $msg = new Message($message);

        $msh = $msg->getSegmentsByName("MSH")[0];
        $rf1 = $msg->getSegmentsByName("RF1")[0];
        $pid = $msg->getSegmentsByName("PID")[0];
        $prds = [];
        
        foreach ($msg->getSegmentsByName("PRD") as $prd) {
            $prdArr = [
                'provider_role'    => getArrayKeyOrString($prd->getField(1),0),
                'provider_number'  => getArrayKeyOrString($prd->getField(7),0),
            ];
            array_push($prds, $prdArr);
        }
        
        $data_content = getDataFromHL7($message);
        
        return  [
            'file_name' => $filename, // For testing purposes only
            'msh' => [
                'sending_application'   => $msh->getField(3),
                'sending_facility'      => getArrayKeyOrString($msh->getField(4), 0),
                'receiving_application' => $msh->getField(5),
                'receiving_facility'    => $msh->getField(6),
                'message_time'          => $msh->getField(7),
                'message_type'          => $msh->getField(9)[0],
            ],
            'rf1'=> [
                'referral_status'       => getArrayKeyOrString($rf1->getField(1),0), //P^Pending^HL70283
                'referral_priority'     => getArrayKeyOrString($rf1->getField(2),0), //R^Routine^HL70280
                'referral_type'         =>  getArrayKeyOrString($rf1->getField(3),0), //MED^Medical^HL70281
                'referral_disposition'  => $rf1->getField(4) ? $rf1->getField(4)[1] : "", //DS^Discharge Summary^HL70282
                'referral_reason'       => $rf1->getField(10) ? $rf1->getField(10)[1]  : "", //E^Event Summary^HL70336
            ],
            'prds' => $prds,
            'pid'=> [
                'patient_first_name' => $pid->getField(5)[1],
                'patient_last_name'  => $pid->getField(5)[0],
                'patient_dob'       => $pid->getField(7),
            
            ],
            'document_contents' => $data_content,
        ];
    }
    public function testHL7Create(Request $request){
        $msg = new Message();

        // MSH
        $msh = new MSH();
        $msg->addSegment($msh); 
        
        // PID
        $lastname = "Herrmann";
        $firstname = "Kaylee";
        $middlename = "Grace";
        $suffix = "Miss";
        $dateOfBirth = "19931009";

        $pid = new PID(); 
        $pid->setPatientName([$lastname, $firstname, $middlename, $suffix]); 
        $pid->setSex('F');
        $pid->setDateTimeOfBirth($dateOfBirth); 
        $msg->addSegment($pid);

        // OBR
        $obr = new OBR(); 

        $msg->addSegment($obr);
        // OBX
        $obx = new OBX();  
        $obx->setValueType('ED');
        $obx->setObservationIdentifier('PDF^Display format in PDF');

        $testDoc = PatientDocument::find(4);
        $file = Storage::disk('local')->get("files/1/". $testDoc->file_path);
        $pdf64 =  chunk_split(base64_encode($file));

        $obx->setObservationValue('^TX^PDF^Base64^'. str_replace("\r\n",'', $pdf64));
        $msg->addSegment($obx);

        Storage::put('public/testHL7/1 (40).hl7', str_replace('\n',"\r\n",$msg->toString()));
        

        return $msg->toString();
    }
}
