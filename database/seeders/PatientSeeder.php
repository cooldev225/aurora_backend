<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\PatientBilling;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::factory(20)->create();

        $arrPatients = Patient::all();

        foreach ($arrPatients as $patient) {
            if ($patient->id == 1) {
                $patient->email = 'it@aurorasoftware.com.au';
                $patient->preferred_contact_method = 'email';
            } else if ($patient->id == 2) { 
                $patient->contact_number = '0481183422';
                $patient->preferred_contact_method = 'sms';
            } else if ($patient->id == 3) {
                $patient->email = 'alexp753159@gmail.com';
                $patient->preferred_contact_method = 'email';
            } else if ($patient->id == 4) { 
                $patient->contact_number = '12096833783';
                $patient->preferred_contact_method = 'sms';
            }

            if ($patient->id >= 1 && $patient->id <= 4) {
                $patient->save();
            }

            PatientBilling::create([
                'patient_id'    =>  $patient->id
            ]);
        }
    }
}
