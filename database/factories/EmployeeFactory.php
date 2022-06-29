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
            $clinics = Clinic::select('id')
                ->where('organization_id', $user->organization_id)
                ->inRandomOrder()
                ->limit(10)
                ->get()
                ->toArray();

            foreach ($clinics as $key => $clinic) {
                $clinics[$key] = $clinic['id'];
            }

            $work_hours = $work_hours + [
                $week_day => [
                    'available' => mt_rand(1, 2) == 1 ? true : false,
                    'time_slot' => ['09:00:00', '17:00:00'],
                    'locations' => $clinics,
                ],
            ];
        }

        return [
            'user_id' => $user->id,
            'work_hours' => json_encode($work_hours),
        ];
    }
}
