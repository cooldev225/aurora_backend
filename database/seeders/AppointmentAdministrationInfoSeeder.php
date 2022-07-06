<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AppointmentAdministrationInfo;
use App\Models\Specialist;

class AppointmentAdministrationInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppointmentAdministrationInfo::factory(10)->create();

        $specialists = Specialist::all();

        foreach ($specialists as $specialist) {
            $rand = mt_rand(1, 3);

            for ($i = 0; $i < $rand; $i++) {
                $appointmentAdministrationInfo = AppointmentAdministrationInfo::factory()->create();
                $appointment = $appointmentAdministrationInfo->appointment();
                $appointment->specialist_id = $specialist->id;

                $appointment->save();
            }
        }
    }
}
