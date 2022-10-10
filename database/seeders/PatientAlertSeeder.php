<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\PatientAlert;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;

class PatientAlertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $patients = Patient::all();

        foreach ($patients as $patient) {
            for ($i = 0; $i < 4; $i++) {
                if (rand(1, 2) === 1) {

                    PatientAlert::create([
                        'patient_id'    => $patient->id,
                        'created_by'    => rand(1, 10),
                        'title'         => $faker->sentence(3),
                        'explanation'   =>  $faker->sentence(17),
                        'alert_level'   => $faker->randomElement(['NOTICE', 'WARNING', 'BLACKLISTED']),
                        'is_dismissed'  =>  rand(1, 5) == 1 ? 0 : 1,
                    ]);
                }
            }
        }
    }
}
