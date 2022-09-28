<?php

use Aranyasen\HL7\Message;
use Carbon\Carbon;

if (!function_exists('formatHL7Text')) {
    function formatHL7Text($unformattedText)
    {
        if (is_array($unformattedText)) {
            implode("\.br\\", $unformattedText);
        }

        $formatted = str_replace("\S\\", "^", $unformattedText);
        $formatted = str_replace("\R\\", "~", $formatted);
        $formatted = str_replace("\E\\", "\\", $formatted);
        $formatted = str_replace("\T\\", "&", $formatted);
        $formatted = str_replace("\F\\", "|", $formatted);

        $formatted = str_replace("\.nf\\", "", $formatted);
        $formatted = str_replace("\H\\", "<span style='background: yellow'>",     $formatted);
        $formatted = str_replace("\N\\", "</span>",     $formatted);
        $formatted = str_replace("\.br\\", "<br>",     $formatted);
        return $formatted;
    }
}

if (!function_exists('getDataFromHL7')) {
    function getDataFromHL7($hl7)
    {

        $msg = new Message($hl7);

        $msh = $msg->getSegmentsByName("MSH")[0];

        //Application Info
        $message_sending_application = $msh->getSendingApplication();
        $message_receiving_application = $msh->getReceivingApplication();

        // Sending Facility
        $send_fal_frame = $msh->getSendingFacility();
        $message_sending_facility_edi = is_array($send_fal_frame) ? $send_fal_frame[0] : $send_fal_frame;
        $message_sending_facility_name = is_array($send_fal_frame) ? $send_fal_frame[1] : "";


        // Receiving Facility
        $rec_fal_frame = $msh->getReceivingFacility();
        $message_receiving_facility_edi = is_array($rec_fal_frame) ? $rec_fal_frame[0] : $rec_fal_frame;
        $message_receiving_facility_name = is_array($rec_fal_frame) ? $rec_fal_frame[1] : "";

        // PATIENT DETAILS
        $pid = $msg->getSegmentsByName("PID")[0];
        $patient_first_name = $pid->getPatientName()[1];
        $patient_last_name = $pid->getPatientName()[0];
        $dob_str = $pid->getDateTimeOfBirth();
        $dob_carbon = Carbon::create(substr($dob_str, 0, 4), substr($dob_str, 4, 2), substr($dob_str, 6, 2));
        $patient_date_of_birth = $dob_carbon->toDateString();

        //REFERRING DOCTOR
        $pv1 = $msg->getSegmentsByName("PV1");
        $referring_doctor_provider = "";
        $receiving_doctor_provider = "";
        if ($pv1) {
            $pv1 = $pv1[0];

            $ref_doc_frame = $pv1->getReferringDoctor();
            $referring_doctor_provider = is_array($ref_doc_frame) ? $ref_doc_frame[0] : $ref_doc_frame;
            //RECEIVING DOCTOR
            $rec_doc_frame = $pv1->getConsultingDoctor();
            $receiving_doctor_provider = is_array($rec_doc_frame) ? $rec_doc_frame[0] : $rec_doc_frame;
        }


        $data_content = [];

        foreach ($msg->getSegments() as $segment) {
            if ($segment->getName() == 'OBR') {
                $serviceId = $segment->getUniversalServiceID();
                $data_title = $serviceId ? '<strong>' . formatHL7Text($serviceId[1]) . '</strong>' : ''; //[4]
                array_push($data_content, array('type' => 'TITLE', 'content' => $data_title));
            } elseif ($segment->getName() == 'OBX') {
                $type = $segment->getValueType(); // [2]
                $observationValue = $segment->getObservationValue(); // [5]
                $observationIdentifier = $segment->getObservationIdentifier(); // [3]
                $observationUnit = $segment->getUnits(); // [6]
                $observationReferenceRange = $segment->getReferenceRange(); //[7]
                switch ($type) {
                    case 'NM':
                        $formatted = $observationIdentifier[1] . ' : ' . $observationValue . ' ' . $observationUnit . ' (' . $observationReferenceRange . ')';
                        array_push($data_content, array('type' => 'NUMERIC', 'content' => $formatted));
                        break;
                    case 'ED':
                        if ($observationValue && $observationValue[1] == 'PDF') {
                            array_push($data_content, array('type' => 'PDF', 'content' => $observationValue[3]));
                        }
                        break;
                    case 'TX':
                        $formatted = $observationIdentifier[1] . ' : ' . $observationValue . ' ' . $observationUnit;
                        array_push($data_content, array('type' => 'TEXT', 'content' => $formatted));
                        break;
                    case 'FT':
                        array_push($data_content, array('type' => 'FORMATTED_TEXT', 'content' =>  formatHL7Text($observationValue)));
                        break;
                    default:
                        array_push($data_content, array('type' => 'UNKNOWN', 'content' =>  $type));
                }
            }
        }

        return $data = [
            'patient_first_name'    => $patient_first_name,
            'patient_last_name'     => $patient_last_name,
            'patient_date_of_birth' => $patient_date_of_birth,
            'message_sending_application' => $message_sending_application,
            'message_sending_facility_edi' => $message_sending_facility_edi,
            'message_sending_facility_name' => $message_sending_facility_name,
            'message_receiving_application' => $message_receiving_application,
            'message_receiving_facility_edi' => $message_receiving_facility_edi,
            'message_receiving_facility_name' => $message_receiving_facility_name,
            'referring_doctor_provider' => $referring_doctor_provider,
            'receiving_doctor_provider' => $receiving_doctor_provider,
            'data_content' => $data_content,
        ];
    }
}

if (!function_exists('formatHL7BodyToHTML')) {
    function formatHL7BodyToHTML($datContentArray)
    {
        $contentHTML = "";
        foreach ($datContentArray as  $data) {
            if ($data['type'] == 'PDF') {
                $contentHTML .=  "<iframe class='pdf-iframe' src='data:application/pdf;base64," . $data['content'] . "'>";
            } else {
                $contentHTML .= $data['content'];
            }
            $contentHTML .= '<br/>';
        }

        return $contentHTML;
    }
}
