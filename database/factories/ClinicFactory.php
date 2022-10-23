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
            'organization_id'           => 2,
            'name'                      => $this->faker->catchPhrase(),
            'nickname_code'             => $this->faker->word(),
            'email'                     => $this->faker->unique()->safeEmail(),
            'phone_number'              => $this->faker->numerify('0#-####-####'),
            'fax_number'                => $this->faker->numerify('0#-####-####'),
            'hospital_provider_number'  => $this->faker->numerify('AU####'),
            'VAED_number'               => Str::random(5),
            'address'                   => $this->faker->streetAddress(),
            'specimen_collection_point_number' => $this->faker->numerify('###'),
            'lspn_id'                   => $this->faker->numerify('###'),
        ];
    }
}
