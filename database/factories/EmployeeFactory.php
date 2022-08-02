<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Clinic;
use App\Models\User;
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
        $user = User::factory()->create([
            'role_id' => UserRole::employeeRoles()
                ->inRandomOrder()
                ->first()->id,
        ]);

        $organization_count = Organization::count();

        $user->organization_id = $user->id % $organization_count + 1;

        $user->save();

        $week_days = [
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday',
        ];

        $work_hours = [];

        foreach ($week_days as $week_day) {
            $clinics = Clinic::select('id', 'name')
                ->where('organization_id', $user->organization_id)
                ->inRandomOrder()
                ->first()
                ->toArray();

            $work_hours = $work_hours + [
                $week_day => [
                    'available' => mt_rand(1, 2) == 1 ? true : false,
                    'appointment_type' => $this->faker->randomElement([
                        'procedure',
                        'consultation'
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
            'user_id'                => $user->id,
            'work_hours'             => json_encode($work_hours),
            'document_letter_header' => $this->faker->imageUrl(),
            'document_letter_footer' => $this->faker->imageUrl(),
            'signature'              => $this->faker->imageUrl(),
        ];
    }
}
