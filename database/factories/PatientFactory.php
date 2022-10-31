<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'title' => $this->faker->title(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'contact_number' => $this->faker->unique()->numerify('0#-####-####'),
            'date_of_birth' => $this->faker->date(),
            'address' => $this->faker->streetAddress(),
            'suburb' =>  $this->faker->word(),
            'postcode' => $this->faker->numerify('####'),
            'country_of_birth' => '0000',
            'birth_place_code' => $this->faker->cityPrefix(),
            'birth_state' => $this->faker->state(),
            'occupation' => $this->faker->word(),
            'height' => mt_rand(170, 200),
            'weight' => mt_rand(50, 120),
            'kin_name' => $this->faker->firstName(),
            'kin_relationship' => $this->faker->word(),
            'kin_phone_number' => $this->faker->unique()->numerify('0#-####-####'),
            'kin_email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
