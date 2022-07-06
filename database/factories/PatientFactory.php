<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'UR_number' => $this->faker->numerify('AA####'),
            'title' => $this->faker->title(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'home_number' => $this->faker->unique()->phoneNumber(),
            'work_number' => $this->faker->unique()->phoneNumber(),
            'mobile_number' => $this->faker->unique()->phoneNumber(),
            'date_of_birth' => $this->faker->date(),
            'address' => $this->faker->streetAddress(),
            'street' => $this->faker->streetName(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'postcode' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'birth_place_code' => $this->faker->cityPrefix(),
            'country_of_birth' => $this->faker->country(),
            'birth_state' => $this->faker->state(),
            'allergies' => $this->faker->sentence(),
            'aborginality' => mt_rand(1, 2) == 1 ? true : false,
            'occupation' => $this->faker->word(),
            'height' => mt_rand(170, 200),
            'weight' => mt_rand(50, 120),
            'bmi' => mt_rand(185, 250) / 10.0,
        ];
    }
}
