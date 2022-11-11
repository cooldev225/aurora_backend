<?php

namespace Database\Factories;

use App\Enum\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\Room;
use App\Models\Organization;
use App\Models\Specialist;
use App\Models\AppointmentType;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $organization = Organization::first();
        $organization_id = 1;
        $specialist = $organization->users->where('role_id', UserRole::SPECIALIST)->random(1)->first();
        $appointment_type = $organization->appointment_types->random(1)->first();

        $appointment_time = $organization->appointment_length;

        if ($appointment_type->appointment_time == 'DOUBLE') {
            $appointment_time = $appointment_time * 2;
        } elseif ($appointment_type->appointment_time == 'TRIPLE') {
            $appointment_time = $appointment_time * 3;
        }

        $working_slots = 2;
        $unixTime =
            strtotime('09:00:00') +
            mt_rand(0, $working_slots) * $appointment_time * 60;
        $unixTime =
            round($unixTime / ($appointment_time * 60)) *
            ($appointment_time * 60);
        $start_time = date('H:i:s', $unixTime);
        $end_time = date('H:i:s', $unixTime + $appointment_time * 60);

        if ($start_time > $end_time) {
            $temp = $start_time;
            $end_time = $start_time;
            $start_time = $temp;
        }

        $arrival_time = $start_time;

        if ($appointment_type->anesthetist_required == false) {
            $procedure_approval_status = 'NOT_RELEVANT';
        } else {
            $procedure_approval_status = $this->faker->randomElement([
                'NOT_ASSESSED',
                'NOT_APPROVED',
                'APPROVED',
            ]);
        }

        $clinic_id = Clinic::where('organization_id', $organization_id)
            ->inRandomOrder()
            ->first()->id;

        $room_id = Room::where('organization_id', $organization_id)
            ->where('clinic_id', $clinic_id)
            ->inRandomOrder()->first()->id;

        $confirmation_status = $this->faker->randomElement([
            'PENDING',
            'CONFIRMED',
            'CANCELED',
            'MISSED',
        ]);

        $date = $this->faker->date();

        return [
            'organization_id'           => $organization_id,
            'clinic_id'                 => $clinic_id,
            'specialist_id'             => $specialist->id,
            'room_id'                   => $room_id,
            'anesthetist_id'            => $specialist->hrmUserTemplateBaseSchedulesTimeDay(strtotime($start_time),strtoupper(Carbon::parse($date)->format('D')))?->anesthetist_id,
            'appointment_type_id'       => $appointment_type->id,
            'date'                      => $date,
            'arrival_time'              => $arrival_time,
            'start_time'                => $start_time,
            'end_time'                  => $end_time,
            'procedure_approval_status' => $procedure_approval_status,
            'confirmation_status'       => $confirmation_status,
            'note'                      => $this->faker->paragraph(),
            'collecting_person_name'    => $this->faker->name(),
            'collecting_person_phone'   => $this->faker->numerify('0#-####-####'),
            'collecting_person_alternate_contact' => $this->faker->catchPhrase(),
        ];
    }
}
