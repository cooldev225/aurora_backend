<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Organization;
use App\Models\Patient;
use App\Models\Specialist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientClinicalNote>
 */
class PatientClinicalNoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'appointment_id'        => Appointment::inRandomOrder()->first()->id,
            'description'           => $this->faker->text(),
            'diagnosis'             => $this->faker->text(),
            'clinical_assessment'   => $this->faker->text(),
            'treatment'             => $this->faker->text(),
            'history'               => $this->faker->text(),
            'additional_details'    => $this->faker->text(),
            'attached_documents'    => $this->faker->text(),
        ];
    }
}
