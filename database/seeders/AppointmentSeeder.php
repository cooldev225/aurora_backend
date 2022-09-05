<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\AppointmentPreAdmission;
use App\Models\AppointmentReferral;
use App\Models\Organization;
use Faker\Factory;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dates = [];

        for ($i = -2; $i < 3; $i++) {
            $dates[] = date('Y-m-d', strtotime("+{$i} days"));
        }

        $patients = Patient::all();
        $faker = Factory::create();

        foreach ($patients as $patient) {
            foreach ($dates as $date) {
                $appointment = $this->createAppointment($date);

                AppointmentReferral::factory()->create(
                    ['appointment_id' => $appointment->id]
                );

                AppointmentPreAdmission::create([
                    'appointment_id'        =>  $appointment->id,
                    'token'                 =>  md5($appointment->id),
                    'pre_admission_file'    =>  "https://pspdfkit.com/downloads/pspdfkit-web-demo.pdf"
                ]);

                $appointment->patient_id = $patient->id;

                $appointment->save();
            }
        }
    }

    /**
     * Create Appointment With out conflict
     *
     * @return Appointment
     */
    public function createAppointment($date)
    {
        $appointment = Appointment::factory()->create([
            'date' => $date,
        ]);

        $appointment_time = Organization::find($appointment->organization_id)->appointment_length;

        $allAppointments = Appointment::all();
        $conflict = 1;

        while ($conflict > 0) {
            $conflict = 0;

            $appointment->start_time = date(      'H:i:s',
                strtotime($appointment->start_time) + $appointment_time * 60
            );
            $appointment->end_time = date(
                'H:i:s',
                strtotime($appointment->end_time) + $appointment_time * 60
            );

            foreach ($allAppointments as $apt) {
                if (
                    $apt->date == $appointment->date &&
                    $apt->specialist_id == $appointment->specialist_id &&
                    $apt->checkConflict(
                        $appointment->start_time,
                        $appointment->end_time
                    )
                ) {
                    $conflict++;
                    break;
                }
            }
        }

        $appointment->save();

        return $appointment;
    }
}
