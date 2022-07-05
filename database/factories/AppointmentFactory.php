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
        $start_time = $this->faker->time();
        $end_time = $this->faker->time();

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

        return [
            'patient_id' => $patient->id,
            'organization_id' => $organization_id,
            'clinic_id' => Clinic::where('organization_id', $organization_id)
                ->inRandomOrder()
                ->first()->id,
            'specialist_id' => $specialist->id,
            'room_id' => Room::inRandomOrder()->first()->id,
            'anesthetist_id' => $specialist->anesthetist_id,
            'reference_number' => mt_rand(1, 9999),
            'date' => $this->faker->date(),
            'arrival_time' => $arrival_time,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'skip_coding' => mt_rand(1, 2) == 1 ? true : false,
        ];
    }
}
