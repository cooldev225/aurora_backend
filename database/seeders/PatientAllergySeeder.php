<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\PatientAllergy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;

class PatientAllergySeeder extends Seeder
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
       
        for ($i=0; $i < 6; $i++) { 
            if(rand(1, 2) === 1){

                PatientAllergy::create([
                    'patient_id'    => $patient->id,
                    'name'          =>  $faker->sentence(1),
                    'severity'      => $faker->randomElement(['MILD','MODERATE','SEVERE']),
                    'symptoms'      =>  $faker->sentence(3),
                ]);
            }
        }
         
           
        }
    }
}
