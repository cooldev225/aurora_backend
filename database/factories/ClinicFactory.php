<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Organization;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clinic>
 */
class ClinicFactory extends Factory
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
            'name' => $this->faker->catchPhrase(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'fax_number' => $this->faker->phoneNumber(),
            'hospital_provider_number' => $this->faker->numerify('AU####'),
            'VAED_number' => Str::random(5),
            'address' => $this->faker->streetAddress(),
            'street' => $this->faker->streetName(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'postcode' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'timezone' => $this->faker->timezone(),
            'specimen_collection_point_number' => $this->faker->numerify('###'),
            'footnote_signature' => $this->faker->imageUrl(),
            'default_start_time' => '07:30:00',
            'default_end_time' => '17:00:00',
            'default_meal_time' => $this->faker->randomElement([20, 30]),
            'latest_invoice_no' => $this->faker->numerify('HH###########'),
            'latest_invoice_pathology_no' => $this->faker->numerify(
                'HH###########'
            ),
            'centre_serial_no' => mt_rand(1, 9999),
            'centre_last_invoice_serial_no' => mt_rand(1, 9999),
        ];
    }
}
