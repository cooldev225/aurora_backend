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
        $msg = new Message($hl7);
        $data_content = '';

        foreach ($msg->getSegments() as $segment) {
            if ($segment->getName() == 'OBR') {
                $serviceId = $segment->getUniversalServiceID();
                $title = getArrayKeyOrString($serviceId, 1);
                $title_heading = '<h1>' . cleanHL7Text(ucwords(strtolower($title))) . '</h1>';
                $data_content .= $title_heading  . '<br/>';
            } elseif ($segment->getName() == 'OBX') {
                $type = $segment->getValueType(); // [2]
                $observationValue = $segment->getObservationValue(); // [5]
                $observationIdentifier = $segment->getObservationIdentifier(); // [3]
                $observationUnit = $segment->getUnits(); // [6]
                $observationReferenceRange = $segment->getReferenceRange(); //[7]
                $displayType =  getArrayKeyOrString($observationIdentifier, 0);
                $data = getOBXdataAsHTML($observationValue, $displayType);
                $data_content .=  $data . '<br/>'; 
            }
        }


        return $data_content;
    }
}

if (!function_exists('parseHeathLinkHL7message')) {
function parseHeathLinkHL7message($message, $filename = ""){


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
}
if (!function_exists('getOBXdataAsHTML')) {
    function getOBXdataAsHTML($data, $type)
    {
        // TYPES: PDF -- HTML -- LETTER -- TXT -- FT -- DS

        if(is_array($data) && $type != 'PDF'){
            $data = implode($data); // This is because in some case incoming messages add '&' unescaped and HL7 parser splits that string to an array
        } 

        switch ($type) {
            case 'PDF':
                return "<iframe class='pdf-iframe' src='data:application/pdf;base64," . $data[3] . "'>";
            case 'HTML':
            case 'LETTER': // 
            case 'TXT':
            case 'FT': // Formatted Text
            case 'REF':
            case 'MED':
            case 'DS': //DISCHARGE SUMMERY
                return cleanHL7Text($data);

                return $data;
                break;
            case 'RTF':
                return $data;
                break;
            default:
                dd('getOBXdataAsHTML : UNKNOWN FILE TYPE (' . $type . ')');
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

if (!function_exists('formatHL7BodyToHTML')) {
    function formatHL7BodyToHTML($datContentArray)
    {
        $contentHTML = "";
        foreach ($datContentArray as  $data) {
            if ($data['type'] == 'PDF') {

                $contentHTML .=  "<iframe class='pdf-iframe' src='data:application/pdf;base64," . $data['content'] . "'>";
            } else {
                if (is_array($data['content'])) {
                    foreach ($data['content'] as $data) {
                        $contentHTML .= $data;
                    }
                } else {
                    $contentHTML .= $data['content'];
                }
            }
            $contentHTML .= '<br/>';
        }

        return $contentHTML;
    }
}
