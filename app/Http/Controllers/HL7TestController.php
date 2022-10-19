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

        $msg = new Message($testHL7Content);
        $msh = $msg->getSegmentsByName("MSH")[0];
        $messageType = $msh->getField(9)[0];
        if($messageType =="REF"){
            return view('hl7ParsingREF', parseHeathLinkHL7RefMessage($msg, $filename));
        }else{
            return view('hl7ParsingORU', parseHeathLinkHL7OruMessage($msg, $filename));
        } 

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
