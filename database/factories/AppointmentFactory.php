<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Clinic;
use App\Models\Employee;
use App\Models\Patient;
use App\Models\Room;
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

        $patient = Patient::inRandomOrder()->first();
        $organization_id = Organization::inRandomOrder()->first()->id;

        return [
            'patient_id' => $patient->id,
            'organization_id' => $organization_id,
            'clinic_id' => Clinic::where('organization_id', $organization_id)
                ->inRandomOrder()
                ->first()->id,
            'primary_pathologist_id' => Employee::pathologists($organization_id)
                ->inRandomOrder()
                ->first()->id,
            'specialist_id' => Specialist::organizationSpecialists(
                $organization_id
            )
                ->inRandomOrder()
                ->first()->id,
            'room_id' => Room::inRandomOrder()->first()->id,
            'anesthetist_id' => Employee::anesthetists($organization_id)
                ->inRandomOrder()
                ->first()->id,
            'reference_number' => mt_rand(1, 9999),
            'date' => $this->faker->date(),
            'arrival_time' => $arrival_time,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'skip_coding' => mt_rand(1, 2) == 1 ? true : false,
        ];
    }
}
