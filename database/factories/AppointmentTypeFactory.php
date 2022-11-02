<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Organization;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppointmentType>
 */
class AppointmentTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'organization_id' => Organization::inRandomOrder()->first()->id,
            'type' => $this->faker->randomElement([
                'CONSULTATION',
                'PROCEDURE',
            ]),
            'color' => $this->faker->hexcolor(),
            'name' => $this->faker->catchPhrase(),
            'invoice_by' => $this->faker->randomElement([
                'CLINIC',
                'SPECIALIST',
            ]),
            'arrival_time' => $this->faker->numberBetween(1, 123),
            'appointment_time' => $this->faker->randomElement([
                'SINGLE',
                'DOUBLE',
                'TRIPLE',
            ]),
            'anesthetist_required' => $this->faker->randomElement([
                true,
                false,
            ]),
        ];
    }
}
