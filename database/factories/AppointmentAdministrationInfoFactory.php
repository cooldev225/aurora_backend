<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Appointment;

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
        $appointment = Appointment::factory()->create([
            'date' => date('Y-m-d'),
        ]);

        return [
            'appointment_id' => $appointment->id,
            'note' => $this->faker->paragraph(),
            'important_details' => $this->faker->paragraph(),
            'clinical_alerts' => $this->faker->paragraph(),
            'further_details' => $this->faker->sentence(),
            'fax_comment' => $this->faker->sentence(),
            'anything_should_aware' => $this->faker->sentence(),
            'collecting_person_name' => $this->faker->name(),
            'collecting_person_phone' => $this->faker->phoneNumber(),
            'collecting_person_alternate_contact' => $this->faker->catchPhrase(),
        ];
    }
}
