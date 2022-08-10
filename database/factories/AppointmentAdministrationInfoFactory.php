<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppointmentAdministrationInfo>
 */
class AppointmentAdministrationInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'appointment_id' => 0,
            'note' => $this->faker->paragraph(),
            'clinical_alerts' => $this->faker->paragraph(),
            'collecting_person_name' => $this->faker->name(),
            'collecting_person_phone' => $this->faker->phoneNumber(),
            'collecting_person_alternate_contact' => $this->faker->catchPhrase(),
        ];
    }
}
