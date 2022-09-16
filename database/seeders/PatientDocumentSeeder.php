<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\PatientDocument;
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
                'organization_id'   =>  $appointment->organization_id,
                'appointment_id'    =>  $appointment->id,
                'specialist_id'     =>  $appointment->specialist_id,
            ]);
        }

      

     

        
       // PatientReport::factory(10)->create();
       // PatientSpecialistAudio::factory(10)->create();
       // PatientLetter::factory(10)->create();
       // PatientClinicalNote::factory(10)->create();
    }
}
