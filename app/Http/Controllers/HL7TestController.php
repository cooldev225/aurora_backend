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
        $fileNo = $request->file_num ? $request->file_num : rand(1, 33);
        $filename = "storage/testHL7/1 (" . $fileNo . ").hl7";
        $file = file($filename);
        foreach ($file as $line) {
            $testHL7Content .= $line;
        }

        $HL7data = getDataFromHL7($testHL7Content);
        $htmlData = formatHL7BodyToHTML($HL7data['data_content']);

        $data = [
            'patient_first_name'    =>  $HL7data['patient_first_name'],
            'patient_last_name'     => $HL7data['patient_last_name'],
            'patient_date_of_birth' => $HL7data['patient_date_of_birth'],
            'message_sending_application' => $HL7data['message_sending_application'],
            'message_sending_facility_edi' => $HL7data['message_sending_facility_edi'],
            'message_sending_facility_name' => $HL7data['message_sending_facility_name'],
            'message_receiving_application' => $HL7data['message_receiving_application'],
            'message_receiving_facility_edi' => $HL7data['message_receiving_facility_edi'],
            'message_receiving_facility_name' => $HL7data['message_receiving_facility_name'],
            'referring_doctor_provider' => $HL7data['referring_doctor_provider'],
            'receiving_doctor_provider' => $HL7data['receiving_doctor_provider'],
            'data_content' => $htmlData,
            'file_name' => $filename,
        ];
        return view('hl7Parsing', $data);
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
