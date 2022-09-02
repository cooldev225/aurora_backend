<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\PatientClinicalNote;
use App\Models\PatientDocument;
use App\Models\PatientLetter;
use App\Models\PatientReport;
use App\Models\PatientSpecialistAudio;
use Illuminate\Database\Seeder;

class PatientDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $appointments = Appointment::all();

        foreach ($appointments as $appointment) {
            PatientDocument::factory(2)->create([
                'patient_id'        =>  $appointment->patient_id,
                'appointment_id'    =>  $appointment->id,
                'specialist_id'     =>  $appointment->specialist->id,
            ]);
        }

      

     

        
       // PatientReport::factory(10)->create();
       // PatientSpecialistAudio::factory(10)->create();
       // PatientLetter::factory(10)->create();
       // PatientClinicalNote::factory(10)->create();
    }
}
