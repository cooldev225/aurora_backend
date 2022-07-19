<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientLetterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'patient_id' => Patient::inRandomOrder()->first()->id,
            'from'       => User::inRandomOrder()->first()->id,
            'to'         => User::inRandomOrder()->first()->id,
            'body'       => $this->faker->text()
        ];
    }
}
