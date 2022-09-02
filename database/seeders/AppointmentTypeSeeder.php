<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AppointmentType;

class AppointmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppointmentType::factory(1)->create([
            'organization_id' => 1,
            'type' => 'Procedure',
            'name' => 'Capsule Endoscopy',
            'appointment_time' => 'TRIPLE'
        ]);

        AppointmentType::factory(1)->create([
            'organization_id' => 1,
            'type' => 'Procedure',
            'name' => 'Gastroscopy',
            'appointment_time' => 'TRIPLE'
        ]);
        AppointmentType::factory(1)->create([
            'organization_id' => 1,
            'type' => 'Procedure',
            'name' => 'Colonoscopy and Gastroscopy',
            'appointment_time' => 'DOUBLE'
        ]);
        AppointmentType::factory(1)->create([
            'organization_id' => 1,
            'type' => 'Procedure',
            'name' => 'Colonoscopy',
            'appointment_time' => 'DOUBLE'
        ]);
        AppointmentType::factory(1)->create([
            'organization_id' => 1,
            'type' => 'Consultation',
            'name' => 'Initial Consultation',
            'appointment_time' => 'DOUBLE'
        ]);
        AppointmentType::factory(1)->create([
            'organization_id' => 1,
            'type' => 'Consultation',
            'name' => 'Follow Up Consultation',
            'appointment_time' => 'SINGLE'
        ]);
        AppointmentType::factory(1)->create([
            'organization_id' => 1,
            'type' => 'Consultation',
            'name' => 'Quantitation of breath hydrogen in response',
            'appointment_time' => 'SINGLE'
        ]);


        AppointmentType::factory(4)->create([
            'organization_id' => 2
        ]);

   
    }
}
