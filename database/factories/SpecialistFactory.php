<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;
use App\Models\UserRole;
use App\Models\SpecialistTitle;
use App\Models\SpecialistType;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Specialist>
 */
class SpecialistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $employee = Employee::factory()->create();
        $user = $employee->user();
        $user->role_id = UserRole::where('slug', 'specialist')->first()->id;
        
        $specialist_count = User::where('username', 'specialist_1')->count();
        if ($specialist_count == 0) {
            $user->username = 'specialist_1';
            $user->organization_id = 1;
        }
        $user->save();

        $organization_id = $user->organization()->id;
        $specialist_type = SpecialistType::create([
            'name' => $this->faker->word(),
        ]);
        $specialist_title = SpecialistTitle::factory()->create();

        $anesthetist = Employee::factory()->create();
        $anesthetist_user = $anesthetist->user();
        $anesthetist_user->role_id = UserRole::where(
            'slug',
            'Anesthetist'
        )->first()->id;

        $anesthetist_count = User::where('username', 'anesthetist_1')->count();
        if ($anesthetist_count == 0) {
            $anesthetist_user->username = 'anesthetist_1';
        }

        $anesthetist_user->organization_id = $organization_id;
        $anesthetist_user->save();

        $anesthetist->work_hours = $employee->work_hours;
        $anesthetist->save();

        return [
            'employee_id' => $employee->id,
            'anesthetist_id' => $anesthetist->id,
            'specialist_title_id' => $specialist_title->id,
            'specialist_type_id' => $specialist_type->id,
        ];
    }
}
