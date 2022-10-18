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

        $data_content = [];

        foreach ($msg->getSegments() as $segment) {
            dd($msg);
            if ($segment->getName() == 'OBR') {
                $serviceId = $segment->getUniversalServiceID();
                $title = getArrayKeyOrString($serviceId , 2);
                $title_heading = '<h1>' . formatHL7Text($title) . '</h1>'; 
                dd($title);
                array_push($data_content, array('type' => 'TITLE', 'content' => $title_heading));
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

        return $data_content;
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
                $contentHTML .= $data['content'];
            }
            $contentHTML .= '<br/>';
        }

        return $contentHTML;
    }
}
