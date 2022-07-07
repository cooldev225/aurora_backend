<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Clinic;
use App\Models\Employee;
use App\Models\Patient;
use App\Models\Room;
use App\Models\PatientOrganization;
use App\Models\Organization;
use App\Models\Specialist;
use App\Models\AppointmentType;

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
        $unixTime = strtotime('09:00:00') + mt_rand(0, 32) * 15 * 60;
        $unixTime = round($unixTime / (15 * 60)) * (15 * 60);
        $start_time = date('H:i:s', $unixTime);
        $end_time = date('H:i:s', $unixTime + 15 * 60);

        if ($start_time > $end_time) {
            $temp = $start_time;
            $end_time = $start_time;
            $start_time = $temp;
        }

        $arrival_time = $start_time;

        $organization_id = Organization::inRandomOrder()->first()->id;
        $patient = Patient::factory()->create();

        $patientOrganization = PatientOrganization::where(
            'patient_id',
            $patient->id
        )
            ->where('organization_id', $organization_id)
            ->first();

        if (empty($patientOrganization)) {
            PatientOrganization::create([
                'organization_id' => $organization_id,
                'patient_id' => $patient->id,
            ]);
        }

        $specialist = Specialist::organizationSpecialists($organization_id)
            ->inRandomOrder()
            ->first();

        $appointment_type = AppointmentType::where(
            'organization_id',
            $organization_id
        )
            ->inRandomOrder()
            ->first();

        return [
            'patient_id' => $patient->id,
            'organization_id' => $organization_id,
            'clinic_id' => Clinic::where('organization_id', $organization_id)
                ->inRandomOrder()
                ->first()->id,
            'specialist_id' => $specialist->id,
            'room_id' => Room::inRandomOrder()->first()->id,
            'anesthetist_id' => $specialist->anesthetist_id,
            'appointment_type_id' => $appointment_type->id,
            'reference_number' => mt_rand(1, 9999),
            'date' => $this->faker->date(),
            'arrival_time' => $arrival_time,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'skip_coding' => mt_rand(1, 2) == 1 ? true : false,
        ];
    }
}
