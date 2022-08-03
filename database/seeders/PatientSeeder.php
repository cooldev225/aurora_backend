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
            PatientBilling::create([
                'patient_id'    =>  $patient->id
            ]);
        }
    }
}
