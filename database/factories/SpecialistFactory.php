<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;
use App\Models\UserRole;
use App\Models\SpecialistTitle;
use App\Models\SpecialistType;

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
        $organization_id = $user->organization()->id;
        $specialist_type = SpecialistType::create([
            'name' => $this->faker->word(),
        ]);
        $specialist_title = SpecialistTitle::factory()->create();

        return [
            'specialist_id' => $employee->id,
            'anesthetist_id' => Employee::anesthetists(
                $organization_id
            )->first()->id,
            'specialist_title_id' => $specialist_title->id,
            'specialist_type_id' => $specialist_type->id,
        ];
    }
}
