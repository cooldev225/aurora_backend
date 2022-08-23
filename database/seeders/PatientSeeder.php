<?php

namespace Database\Seeders;

use App\Models\Organization;
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
                $patient->email = 'kaylee@ojc.com.au';
                $patient->appointment_confirm_method = 'email';
            } else if ($patient->id == 2) { 
                $patient->contact_number = '04-8118-3422';
                $patient->appointment_confirm_method = 'sms';
            }

            if ($patient->id >= 1 && $patient->id <= 2) {
                $patient->save();
            }

            PatientBilling::create([
                'patient_id'    =>  $patient->id
            ]);

            $patient->organizations()->attach(Organization::inRandomOrder()->first());
        }
    }
}
