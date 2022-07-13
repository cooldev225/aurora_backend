<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AppointmentAdministrationInfo;
use App\Models\Specialist;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Organization;

class AppointmentAdministrationInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dates = [];

        for ($i = -2; $i < 7; $i++) {
            $dates[] = date('Y-m-d', strtotime("+{$i} days"));
        }

        $patients = Patient::all();

        foreach ($patients as $patient) {
            foreach ($dates as $date) {
                $appointment = $this->createAppointment($date);

                $appointmentAdministrationInfo = AppointmentAdministrationInfo::factory()->create(
                    ['appointment_id' => $appointment->id]
                );

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

        $appointment_time = Organization::find($appointment->organization_id)
            ->appointment_length;

        $allAppointments = Appointment::all();
        $conflict = 1;

        while ($conflict > 0) {
            $conflict = 0;

            $appointment->start_time = date(
                'H:i:s',
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
