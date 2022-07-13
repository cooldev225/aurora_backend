<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Appointment;
use App\Models\Organization;

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
        $date = $this->faker->randomElement([
            date('Y-m-d', strtotime('-1 days')),
            date('Y-m-d'),
            date('Y-m-d', strtotime('+1 days')),
            date('Y-m-d', strtotime('+2 days')),
        ]);

        $appointment = Appointment::factory()->create([
            'date' => $date,
        ]);

        $appointment_time = Organization::find($appointment->organization_id)
            ->appointment_length;

        $allAppointments = Appointment::all();

        $conflict = 1;

        while ($conflict > 0) {
            $conflict = 0;

            $appointment->start_time = date(
                'H:i:s',
                strtotime($appointment->start_time) + $appointment_time * 60
            );
            $appointment->end_time = date(
                'H:i:s',
                strtotime($appointment->end_time) + $appointment_time * 60
            );

            foreach ($apt as $allAppointments) {
                if (
                    $apt->date == $appointment->date &&
                    $apt->specialist_id == $appointment->specialist_id &&
                    $apt->checkConflict(
                        $appointment->start_time,
                        $appointment->end_time
                    )
                ) {
                    $conflict++;
                    break;
                }
            }
        }

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
