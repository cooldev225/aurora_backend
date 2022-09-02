<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Clinic;
use App\Models\HRMUserBaseSchedule;
use App\Models\User;
use App\Models\Organization;
use App\Models\UserRole;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $last_organization_id = User::orderByDesc('id')->first()
            ->organization_id;

        $organization_id = Organization::whereNot('id', $last_organization_id)
            ->inRandomOrder()
            ->first()->id;

        $user = User::factory()->create([
            'organization_id' => $organization_id,
        ]);

        $week_days = [
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday',
        ];


        HRMUserBaseSchedule::create([
            'user_id'   => $user->id,
            'clinic_id' => Organization::find($organization_id)->clinics->first()->id,
            'start_time' => $this->faker->randomElement([ '07:00:00', '08:30:00','06:30:00']),
            'end_time' => $this->faker->randomElement( ['16:00:00', '14:30:00','12:30:00']),
            'week_day' => $this->faker->randomElement( ["MON", "TUE","WED"]),
        ]);

        HRMUserBaseSchedule::create([
            'user_id'   => $user->id,
            'clinic_id' => Organization::find($organization_id)->clinics->first()->id,
            'start_time' => $this->faker->randomElement([ '07:00:00', '08:30:00','06:30:00']),
            'end_time' => $this->faker->randomElement( ['16:00:00', '14:30:00','12:30:00']),
            'week_day' => $this->faker->randomElement( ["THU", "FRI", "SAT"]),
        ]);


        $work_hours = [];

        foreach ($week_days as $week_day) {
            $clinics = $user->organization()->clinics()
                ->inRandomOrder()
                ->first()
                ->toArray();

            $work_hours = $work_hours + [
                $week_day => [
                    'appointment_type' => $this->faker->randomElement([
                        'procedure',
                        'consultation',
                    ]),
                    'time_slot' => $this->faker->randomElement([
                        ['06:00:00', '17:30:00'],
                        ['07:00:00', '18:00:00'],
                        ['08:00:00', '19:00:00'],
                        ['09:00:00', '19:30:00'],
                    ]),
                    'locations' => $clinics,
                ],
            ];
        }

        return [
            'user_id' => $user->id,
            'work_hours' => json_encode($work_hours),
            'document_letter_header' => $this->faker->imageUrl(),
            'document_letter_footer' => $this->faker->imageUrl(),
            'signature' => $this->faker->imageUrl(),
        ];
    }
}
