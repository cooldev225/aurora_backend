<?php

namespace Database\Seeders;

use App\Enum\UserRole;
use App\Models\Clinic;
use App\Models\HrmScheduleTimeslot;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\AppointmentCodes;
use App\Models\AppointmentPreAdmission;
use App\Models\AppointmentReferral;
use App\Models\Organization;
use App\Models\PatientRecall;
use App\Models\PatientRecallSentLog;
use App\Models\User;
use Faker\Factory;

class AppointmentSeeder extends Seeder
{
    private \Faker\Generator $faker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dates = [];

        for ($i = -3; $i < 5; $i++) {
            $dates[] = date('Y-m-d', strtotime("+{$i} days"));
        }

        $patients = Patient::all();
        $faker = Factory::create();

        foreach ($patients as $patient) {
             $date = $dates[rand(0, count($dates)-1)];

                $appointment = $this->createAppointment($date, $patient);

                AppointmentCodes::factory()->create(
                    ['appointment_id' => $appointment->id],
                );


                AppointmentReferral::factory()->create(
                    ['appointment_id' => $appointment->id]
                );

                AppointmentPreAdmission::create([
                    'appointment_id' => $appointment->id,
                    'token' => md5($appointment->id),
                ]);
                if (rand(0, 3) == 1) {
                    $recall = PatientRecall::factory()->create([
                        'user_id' => $appointment->specialist_id,
                        'appointment_id' => $appointment->id,
                        'organization_id' => $appointment->organization_id,
                        'patient_id' => $appointment->patient_id,
                    ]);
                    if (rand(0, 3) == 1) {
                        $recallLog = PatientRecallSentLog::create([
                            'patient_recall_id' => $recall->id,
                            'recall_sent_at' => $faker->dateTimeThisYear('+1 month')->format('Y-m-d H:i:s'),
                            'sent_by' => $faker->randomElement(['MAIL', 'EMAIL', 'SMS']),
                        ]);

                        if ($recallLog->sent_by == 'MAIL') {
                            $recallLog->user_id = User::where('role_id', '4')->inRandomOrder()->first()->id;
                            $recallLog->save();
                            if (rand(0, 1) == 1) {
                                PatientRecallSentLog::create([
                                    'patient_recall_id' => $recall->id,
                                    'recall_sent_at' => $faker->dateTimeThisYear('+1 month')->format('Y-m-d H:i:s'),
                                    'sent_by' => 'MAIL',
                                    'user_id' => User::where('role_id', '4')->inRandomOrder()->first()->id
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

    /**
     * Create Appointment With-out conflict
     *
     * @return Appointment
     */
    public function createAppointment($date, $patient)
    {
        $hrmData = $this->getSpecialist($date);
        $appointment = Appointment::factory()->create([
            'date' => $date,
            'patient_id' => $patient->id,
            'specialist_id' => $hrmData['specialist']->id,
            'clinic_id' => $hrmData['hrmTimeSchedule']->clinic_id,
        ]);

        $appointment_time = Organization::find($appointment->organization_id)->appointment_length;
        $allAppointments = Appointment::where('date', $date)->get();
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
                if ($apt->specialist_id == $appointment->specialist_id &&
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
        //            Test this -> make sure there is no appointments outside HRM time schedule
        if ($hrmData['hrmTimeSchedule']->end_time <= $appointment->end_time) {
            $appointment->delete();
//            dd($appointment->id, $appointment->end_time, $hrmData['hrmTimeSchedule']->end_time);
        } else {
            $appointment->save();
        }
        return $appointment;
    }

    public function getSpecialist(string $date)
    {
        $organization = Organization::where('id', 1)->first();
        $specialists = $organization->users->where('role_id', UserRole::SPECIALIST)->shuffle();
        $clinic =Clinic::where('organization_id', 1)->get()->random(1)->first();
        $filteredSpecialist = null;
        foreach ($specialists as $specialist) {
            $hrmTimeSchedule = $this->getHrmTimeSchedule($specialist->id, $date, $clinic->id);
            if ($hrmTimeSchedule !== null) {
                return [
                    'specialist' => $specialist,
                    'clinic' => $clinic,
                    'hrmTimeSchedule' => $hrmTimeSchedule
                ];
            }else {
                $filteredSpecialist = $specialist;
            }
        }
//        $specialist = $organization->users->where('role_id', UserRole::SPECIALIST)->random(1)->first();
        $this->faker = Faker::create();
        $hrmTimeSchedule = HrmScheduleTimeslot::create([
            'organization_id' => 1,
            'clinic_id' => $clinic->id,
            'week_day' => strtoupper(Carbon::parse($date)->shortEnglishDayOfWeek),
            'category' => 'WORKING',
            'user_id' => $filteredSpecialist->id,
            'start_time' => $this->faker->randomElement(['07:00:00', '08:30:00', '06:30:00']),
            'end_time' => $this->faker->randomElement(['16:00:00', '14:30:00', '12:30:00']),
            'is_template' => true,
        ]);
//        dd($specialist->id,  strtoupper(Carbon::parse($date)->shortEnglishDayOfWeek), $clinic->id);
        return [
            'specialist' => $specialist,
            'clinic' => $clinic,
            'hrmTimeSchedule' => $hrmTimeSchedule
        ];
    }

    public function getHrmTimeSchedule(int $userId, string $date, int $clinicId)
    {
        $formattedDate = strtoupper(Carbon::parse($date)->shortEnglishDayOfWeek);
        $hrmScheduleTime = HrmScheduleTimeslot::where([
            ['user_id', '=', $userId],
            ['organization_id', '=', 1],
            ['clinic_id', '=', $clinicId],
            ['week_day', '=', $formattedDate]
        ])->first();

        if ($hrmScheduleTime === null) {
            return null;
        } else {
            return $hrmScheduleTime;
        }
    }

}
