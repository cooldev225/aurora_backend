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
            'organization_id' => Organization::inRandomOrder()
                ->limit(1)
                ->get()[0]->id,
            'name' => $this->faker->title(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'fax_number' => $this->faker->phoneNumber(),
            'hospital_provider_number' => 'AU' . mt_rand(1, 9999),
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
            'specimen_collection_point_number' => Str::random(5),
            'footnote_signature' => Str::random(5),
            'default_start_time' => Str::random(5),
            'default_end_time' => Str::random(5),
            'default_meal_time' => Str::random(5),
            'latest_invoice_no' => Str::random(5),
            'latest_invoice_pathology_no' => Str::random(5),
            'centre_serial_no' => Str::random(5),
            'centre_last_invoice_serial_no' => Str::random(5),
            'lspn_id' => mt_rand(1, 9999),
        ];
    }
}
