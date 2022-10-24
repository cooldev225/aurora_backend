<?php

use Aranyasen\HL7\Message;
use Carbon\Carbon;

if (!function_exists('cleanHL7Text')) {
    function cleanHL7Text($unformattedText)
    {
        if (is_array($unformattedText)) {
            implode("\.br\\", $unformattedText);
        }

        $formatted = str_replace("\S\\", "^", $unformattedText);
        $formatted = str_replace("\R\\", "~", $formatted);
        $formatted = str_replace("\E\\", "\\", $formatted);
        $formatted = str_replace("\T\\", "&", $formatted);
        $formatted = str_replace("\F\\", "|", $formatted);
        $formatted = str_replace("\.ti\\", '&nbsp;&nbsp;&nbsp;&nbsp;', $formatted);
        $formatted = str_replace("\.nf\\", "", $formatted);
        $formatted = str_replace("\H\\", "<strong>",     $formatted);
        $formatted = str_replace("\N\\", "</strong>",     $formatted);
        $formatted = str_replace("\.br\\", "<br>",     $formatted);
        $formatted = str_replace("quot;", "\"",     $formatted);
        return $formatted;
    }
}

if (!function_exists('getDataFromHL7')) {
    function getDataFromHL7($hl7)
    {
        $msg = $hl7;
        $data_content = '';

        foreach ($msg->getSegments() as $segment) {
            if ($segment->getName() == 'OBR') {
                $serviceId = $segment->getUniversalServiceID();

                if($msg->getSegmentsByName("MSH")[0]->getField(4) === "AUSTRALIAN CLINICAL LABS"){
                    $title = $serviceId[1];
                }
                else if (!is_array($serviceId)) {
                    $title = $serviceId;
                } else if ($msg->getSegmentsByName("MSH")[0]->getField(9)[0] === "REF") {
                    $title = getArrayKeyOrString($serviceId, 1);
                } else {
                    $title = getArrayKeyOrString($serviceId, 0);
                }

                $title_heading = '<h1>' . cleanHL7Text(ucwords(strtolower($title))) . '</h1>';
                $data_content .= $title_heading  . '<br/>';
            } elseif ($segment->getName() == 'OBX') {
                $type = $segment->getValueType(); // [2]



                $observationValue = $segment->getObservationValue(); // [5]
                $observationIdentifier = $segment->getObservationIdentifier(); // [3]
                $observationUnit = $segment->getUnits(); // [6]
                $observationReferenceRange = $segment->getReferenceRange(); //[7]
                $displayType =  getArrayKeyOrString($observationIdentifier, 0);



                switch ($type) {
                    case 'FT': //FORMATTED TEXT
                    case 'ED': //ENCAPSULATED DATA
                        $data = getOBXdataAsHTML($observationValue, $displayType);
                        break;
                    case 'NM': //NUMERIC
                    case 'SN': //STRUCTURE NUMERIC
                        $observationValue = is_array($observationValue) ? implode($observationValue) : $observationValue;
                        $data = '&nbsp;&nbsp;&nbsp;&nbsp;' . $observationIdentifier[1] . ' : ' . $observationValue . ' ' . $observationUnit . ' (' . $observationReferenceRange . ')';
                        break;
                    default:
                        dd($observationValue);
                        dd('DATA TYPE UNACCOUNTED FOR:' . $type);
                        break;
                }

                $data_content .=  $data . '<br/>';
            }
        }


        return $data_content;
    }
}

if (!function_exists('parseHeathLinkHL7RefMessage')) {
    function parseHeathLinkHL7RefMessage($msg, $filename = "")
    {

        $msh = $msg->getSegmentsByName("MSH")[0];
        $rf1 = $msg->getSegmentsByName("RF1")[0];
        $pid = $msg->getSegmentsByName("PID")[0];
        $prds = [];

        foreach ($msg->getSegmentsByName("PRD") as $prd) {
            $prdArr = [
                'provider_role'    => getArrayKeyOrString($prd->getField(1), 0),
                'provider_number'  => getArrayKeyOrString($prd->getField(7), 0),
            ];
            array_push($prds, $prdArr);
        }

        $data_content = getDataFromHL7($msg);

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
            'rf1' => [
                'referral_status'       =>  getArrayKeyOrString($rf1->getField(1), 0), //P^Pending^HL70283
                'referral_priority'     =>  getArrayKeyOrString($rf1->getField(2), 0), //R^Routine^HL70280
                'referral_type'         =>  getArrayKeyOrString($rf1->getField(3), 0), //MED^Medical^HL70281
                'referral_disposition'  => $rf1->getField(4) ? $rf1->getField(4)[1] : "", //DS^Discharge Summary^HL70282
                'referral_reason'       => $rf1->getField(10) ? getArrayKeyOrString($rf1->getField(10), 0)  : "", //E^Event Summary^HL70336
            ],
            'prds' => $prds,
            'pid' => [
                'patient_first_name' => $pid->getField(5)[1],
                'patient_last_name'  => $pid->getField(5)[0],
                'patient_dob'       => $pid->getField(7),

            ],
            'document_contents' => $data_content,
        ];
    }
}

if (!function_exists('parseHeathLinkHL7OruMessage')) {
    function parseHeathLinkHL7OruMessage($msg, $filename = "")
    {

        $msh = $msg->getSegmentsByName("MSH")[0];
        $pid = $msg->getSegmentsByName("PID")[0];
        $pv1 = $msg->getSegmentsByName("PV1")[0];
        $data_content = getDataFromHL7($msg);

        return  [
            'file_name' => $filename, // For testing purposes only
            'file_number' => $filename, // For testing purposes only
            'msh' => [
                'sending_application'   => $msh->getField(3),
                'sending_facility'      => getArrayKeyOrString($msh->getField(4), 0),
                'receiving_application' => $msh->getField(5),
                'receiving_facility'    => $msh->getField(6),
                'message_time'          => $msh->getField(7),
                'message_type'          => $msh->getField(9)[0],
            ],
            'pid' => [
                'patient_first_name' => $pid->getField(5)[1],
                'patient_last_name'  => $pid->getField(5)[0],
                'patient_dob'       => $pid->getField(7),

            ],
            'pv1' => [
                'attending_doctor' => $pv1->GetField(7)[0],
                'referring_doctor' => $pv1->GetField(8)[0],
                'consulting_doctor'=> $pv1->GetField(9)[0],
            ],
            'document_contents' => $data_content,
        ];
    }
}

if (!function_exists('getOBXdataAsHTML')) {
    function getOBXdataAsHTML($data, $type)
    {
        // TYPES: PDF -- HTML -- LETTER -- TXT -- FT -- DS

        if (is_array($data) && $type != 'PDF') {
            $data = implode($data); // This is because in some case incoming messages add '&' unescaped and HL7 parser splits that string to an array
        }

        switch ($type) {
            case 'PDF':
                if (count($data) == 5) {
                    return "<iframe class='pdf-iframe' src='data:application/pdf;base64," . $data[4] . "'>";
                }
                return "<iframe class='pdf-iframe' src='data:application/pdf;base64," . $data[3] . "'>";
            case 'HTML':
            case 'LETTER': // 
            case 'TXT':
            case 'FT': // Formatted Text
            case 'REF':
            case 'MED':
            case 'DS': //DISCHARGE SUMMERY
                return cleanHL7Text($data);
                break;
            case 'RTF':
                return $data;
                break;
            default:
                return cleanHL7Text($data);
                break;
        }
    }
}

if (!function_exists('getArrayKeyOrString')) {
    function getArrayKeyOrString($data, $key)
    {
        return is_array($data) ? $data[$key] :  $data;
    }
}
