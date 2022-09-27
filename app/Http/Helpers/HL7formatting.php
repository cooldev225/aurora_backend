<?php

use App\Models\Patient;

if (!function_exists('formatHL7Text')) {
    function formatHL7Text($unformattedText)
    {
        if(is_array($unformattedText)){
            implode("\.br\\",$unformattedText);
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


