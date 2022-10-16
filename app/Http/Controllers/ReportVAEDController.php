<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class ReportVAEDController extends Controller
{

    public function generateVAEDforEpisode(Request $request)
    {

        return  '<pre>' . $this->generateEpisodeVAEDString(Appointment::find(30)) . '</pre>';
    }

    public function generateEpisodeVAEDString(Appointment $appointment)
    {
        $patient = $appointment->patient;
        // Generated from oage 11 - 13 of VAED manual Section 5

        $transaction_type = "E5";               // len 2, E5
        $unique_key = str_pad($appointment->id, 9, 0, STR_PAD_LEFT); //len 9, AAAAAAAAA
        $patient_identifier = str_pad($patient->id, 10, 0, STR_PAD_LEFT); // len 10, AAAAAAAAAA
        $campus_code = "2222";                         // len 4, NNNN
        $medicare_number = "11111111111";              // len 11,NNNNNNNNNNN
        $medicare_suffix = str_pad(substr($patient->first_name, 0, 3), 3, " "); // len 3, AAA or A-A
        $sex = $patient->gender;                       // len 1, N
        $marital_status = $patient->marital_status;    // len 1, N
        $date_of_birth = substr($patient->date_of_birth, -2) . substr($patient->date_of_birth, 5, 2) . substr($patient->date_of_birth, 0, 4);   // len 8, DDMMYYYY
        $postcode = $patient->postcode;                // len 4, NNNN
        $locality = str_pad($patient->suburb, 22, ' '); //len 22. Alphanumeric, left justified
        $admission_date = substr($appointment->date, -2) . substr($appointment->date, 5, 2) . substr($appointment->date, 0, 4); // len 8, DDMMYYYY
        $admission_time = substr(str_replace(':', '', $appointment->start_time), 0, 4);   // len 4, HHMM
        $admission_type = $appointment->codes->vaed_admission_type;  //len 1, A
        $admission_source = $appointment->codes->vaed_admission_source;  //len 1, A
        $transfer_source = "    "; // leng 4, NNNN,
        $leave_with_permission_days_MTD = "00"; // leng 1, NN
        $leave_with_permission_days_YTD = "000"; // leng 3, NNN
        $leave_with_permission_days_tot = "000"; // leng 4, NNN


        $status_segments = "";

        // for now only making one but will need to change if we do more that day hospitals.
        $status_segment = "";
        $status_segment .= $appointment->codes->vaed_account_class; // len 2, AA or AN
        $status_segment .= $appointment->codes->vaed_accommodation_type; // len 1, A or N
        $status_segment .= 'X'; // len 1, A, only relevant to pregnancy
        $status_segment .= '01'; // len 2, NN patients days MTD
        $status_segment .= '001'; // len 3, NN patients days finanial YTD
        $status_segment .= '0001'; // len 3, NN patients days tot
        $status_segments .=   $status_segment;

        //These are for subsequent days the patient stays, not relevant to day hospitals
        for ($i = 0; $i < 6; $i++) {
            $status_segment = "";
            $status_segment .= '  '; // len 2, AA or AN
            $status_segment .= ' '; // len 1, A or N
            $status_segment .= ' '; // len 1, A, only relevant to pregnancy
            $status_segment .= '00'; // len 2, NN patients days MTD
            $status_segment .= '000'; // len 3, NN patients days finanial YTD
            $status_segment .= '0000'; // len 3, NN patients days tot
            $status_segments .=  $status_segment;
        }

        $separation_date = substr($appointment->date, -2) . substr($appointment->date, 5, 2) . substr($appointment->date, 0, 4); // len 8, DDMMYYYY
        $separation_time = substr(str_replace(':', '', $appointment->end_time), 0, 4);   // len 4, HHMM
        $separation_mode = $appointment->codes->vaed_separation_mode;  // len 1, A
        $transfer_destination = '    '; // len 4, NNNN
        $separation_referral = '    '; // len 4, AAAA
        $carer_availability = ' '; // len 1, A, NA to private hospitals 
        $account_class_on_separation = $appointment->codes->vaed_account_class; //len 2, AA or NA or NN
        $accommodation_type_on_separation = $appointment->codes->vaed_accommodation_type; // len 1, A or N
        $care_type = str_pad($appointment->codes->vaed_care_type, 2, ' '); //len 2, AA or NA or NN

        $country_of_birth  = "NNNN"; //len 4, NNNN

        $episode_record =
            $transaction_type .
            $unique_key .
            $patient_identifier .
            $campus_code .
            $medicare_number .
            $medicare_suffix .
            $sex .
            $marital_status .
            $date_of_birth .
            $postcode .
            $locality .
            $admission_date .
            $admission_time .
            $admission_type .
            $admission_source .
            $transfer_source .
            $leave_with_permission_days_MTD .
            $leave_with_permission_days_YTD .
            $leave_with_permission_days_tot .
            $status_segments .
            $separation_date .
            $separation_time .
            $separation_mode .
            $transfer_destination.
            $separation_referral.
            $carer_availability.
            $account_class_on_separation .
            $accommodation_type_on_separation.
            $care_type
            ;
        return strtoupper($episode_record);
    }

    //EXAMPLE
    //E50001544810000045936731031742589512ELI25300419573910LANGWARRIN            020520220733PH    00000000PO3X010010001    000000000    000000000                                                    020520220911H         PO34 23084B199999       000000                 000000009AAA            DAY DAY 
    //X5000154481PZ090   PZ8712  PK5730                                                                          3209000 9251529                                                                                                          020520220733        MED0001172477  
}
