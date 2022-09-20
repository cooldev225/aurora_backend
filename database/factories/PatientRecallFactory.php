<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientRecall>
 */
class PatientRecallFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'reason'                 => $this->faker->catchPhrase(),
            'date_recall_due'        => $this->faker->dateTimeBetween('+0 days', '+2 years')
        ];
    }
}
