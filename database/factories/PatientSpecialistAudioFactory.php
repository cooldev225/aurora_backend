<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Specialist;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientSpecialistAudio>
 */
class PatientSpecialistAudioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'patient_id'    => Patient::inRandomOrder()->first()->id,
            'specialist_id' => Specialist::inRandomOrder()->first()->id,
            'file'          => $this->faker->url(),
            'translated_by' => User::inRandomOrder()->first()->id,
        ];
    }
}
