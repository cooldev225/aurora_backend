<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\AppointmentDetail;
use App\Models\AppointmentPreAdmission;
use App\Models\AppointmentReferral;
use App\Models\Organization;
use App\Models\PatientRecall;
use App\Models\PatientRecallSentLog;
use App\Models\User;
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

        for ($i = -5; $i < 10; $i++) {
            $dates[] = date('Y-m-d', strtotime("+{$i} days"));
        }

        $patients = Patient::all();
        $faker = Factory::create();

        foreach ($patients as $patient) {

            for ($i=0; $i < 2; $i++) { 
               
           
             $date = $dates[rand(0, count($dates)-1)];

                $appointment = $this->createAppointment($date, $patient);

                AppointmentDetail::factory()->create(
                    ['appointment_id' => $appointment->id],
                );


                AppointmentReferral::factory()->create(
                    ['appointment_id' => $appointment->id]
                );

                AppointmentPreAdmission::create([
                    'appointment_id'        =>  $appointment->id,
                    'token'                 =>  md5($appointment->id),
                ]);
                if (rand(0, 3) == 1) {
                    $recall = PatientRecall::factory()->create([
                        'user_id'            =>  $appointment->specialist_id,
                        'appointment_id'     =>  $appointment->id,
                        'organization_id'    =>  $appointment->organization_id,
                        'patient_id'         =>  $appointment->patient_id,
                    ]);
                    if (rand(0, 3) == 1) {
                        $recallLog = PatientRecallSentLog::create([
                            'patient_recall_id' => $recall->id,
                            'recall_sent_at'   => $faker->dateTimeThisYear('+1 month')->format('Y-m-d H:i:s'),
                            'sent_by'     => $faker->randomElement(['MAIL', 'EMAIL', 'SMS']),
                        ]);

                        if ($recallLog->sent_by == 'MAIL') {
                            $recallLog->user_id =  User::where('role_id', '4')->inRandomOrder()->first()->id;
                            $recallLog->save();
                            if (rand(0, 1) == 1) {
                                PatientRecallSentLog::create([
                                    'patient_recall_id' => $recall->id,
                                    'recall_sent_at'   => $faker->dateTimeThisYear('+1 month')->format('Y-m-d H:i:s'),
                                    'sent_by'     => 'MAIL',
                                    'user_id' =>  User::where('role_id', '4')->inRandomOrder()->first()->id
                                ]);
                            } else {
                                $recall->confirmed = 1;
                                $recall->save();
                            }
                        } else {
                            $recall->confirmed = 1;
                            $recall->save();
                        }
                    }
                }


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
    public function createAppointment($date,  $patient)
    {
        $appointment = Appointment::factory()->create([
            'date' => $date,
            'patient_id' =>  $patient->id
        ]);

        $appointment_time = Organization::find($appointment->organization_id)->appointment_length;

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
