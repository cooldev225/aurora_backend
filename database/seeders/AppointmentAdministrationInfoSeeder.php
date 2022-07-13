<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AppointmentAdministrationInfo;
use App\Models\Specialist;
use App\Models\Patient;

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

        $patients = Patient::all();

        $dates = [];

        for ($i = -10; $i < 49; $i++) {
            $dates[] = date('Y-m-d', strtotime("+{$i} days"));
        }

        foreach ($patients as $patient) {
            foreach ($dates as $date) {
                $appointmentAdministrationInfo = AppointmentAdministrationInfo::factory()->create();
                $appointment = $appointmentAdministrationInfo->appointment();
                $appointment->patient_id = $patient->id;
                $appointment->date = $date;

                $appointment->save();
            }
        }
    }
}
