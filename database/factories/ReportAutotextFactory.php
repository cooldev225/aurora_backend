<?php

namespace Database\Factories;

use App\Models\ReportSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientOrganization>
 */
class ReportAutotextFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'section_id'    => ReportSection::inRandomOrder()->first()->id,
            'text'          => $this->faker->paragraph(),
        ];
    }
}
