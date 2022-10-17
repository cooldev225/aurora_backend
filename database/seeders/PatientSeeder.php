<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\PatientBilling;
use App\Models\PatientDocument;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::factory(30)->create();

        $arrPatients = Patient::all();

        foreach ($arrPatients as $patient) {
            $patient->organizations()->attach(1);

        }
    }
}
