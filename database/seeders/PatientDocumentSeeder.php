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
            $received  = rand(0, 3);
            PatientDocument::factory(2)->create([
                'patient_id'        =>  $received == 1 ?  null : $appointment->patient_id,
                'organization_id'   =>  $appointment->organization_id,
                'appointment_id'    =>   $appointment->id,
                'specialist_id'     =>  $appointment->specialist_id,
                'origin'            => $received  == 1 ? 'RECEIVED' : 'UPLOADED',
                'is_read'           => rand(0,1),
                'is_urgent'         => rand(0,1),
            ]);
        }
    }
}
