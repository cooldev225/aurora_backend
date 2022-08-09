<?php

namespace Database\Factories;

use App\Models\PreAdmissionSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PreAdmissionQuestion>
 */
class PreAdmissionQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pre_admission_section_id'  => PreAdmissionSection::inRandomOrder()->first()->id,
            'answer_format'             => $this->faker->randomElement(['TEXT', 'BOOLEAN']),
            'text'                      => $this->faker->sentence(),
        ];
    }
}
