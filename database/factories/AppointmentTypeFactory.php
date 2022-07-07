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
                'Consultation',
                'Procedure',
            ]),
            'color' => $this->faker->hexcolor(),
            'mbs_code' => $this->faker->numberBetween(1000, 12345),
            'clinical_code' => $this->faker->numberBetween(1234567, 3234567),
            'name' => $this->faker->catchPhrase(),
            'invoice_by' => $this->faker->randomElement([
                'Clinic',
                'Specialist',
            ]),
            'arrival_time' => $this->faker->numberBetween(1, 123),
            'procedure_price' => $this->faker->numberBetween(1, 123) * 100.0,
            'appointment_time' => $this->faker->randomElement([
                'Single',
                'Double',
                'Triple',
            ]),
            'payment_tier_1' => $this->faker->numberBetween(0, 300),
            'payment_tier_2' => $this->faker->numberBetween(0, 300),
            'payment_tier_3' => $this->faker->numberBetween(0, 300),
            'payment_tier_4' => $this->faker->numberBetween(0, 300),
            'payment_tier_5' => $this->faker->numberBetween(0, 300),
            'payment_tier_6' => $this->faker->numberBetween(0, 300),
            'payment_tier_7' => $this->faker->numberBetween(0, 300),
            'payment_tier_8' => $this->faker->numberBetween(0, 300),
            'payment_tier_9' => $this->faker->numberBetween(0, 300),
            'payment_tier_10' => $this->faker->numberBetween(0, 300),
            'payment_tier_11' => $this->faker->numberBetween(0, 300),
            'anesthetist_required' => $this->faker->randomElement([
                true,
                false,
            ]),
            'status' => $this->faker->randomElement(['Enabled', 'Disabled']),
        ];
    }
}
