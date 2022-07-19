<?php

namespace Database\Seeders;

use App\Models\PatientClinicalNote;
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
        PatientReport::factory(10)->create();
        PatientSpecialistAudio::factory(10)->create();
        PatientLetter::factory(10)->create();
        PatientClinicalNote::factory(10)->create();
    }
}
