<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DoctorAddressBook>
 */
class DoctorAddressBookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'provider_no'           => $this->faker->bothify('####??'),
            'title'                 => $this->faker->title(),
            'first_name'            => $this->faker->firstName(),
            'last_name'             => $this->faker->lastName(),
            'address'               => $this->faker->address(),
            'street'                => $this->faker->streetName(),
            'city'                  => $this->faker->city(),
            'state'                 => $this->faker->city(),
            'country'               => $this->faker->country(),
            'postcode'              => $this->faker->postcode(),
            'phone'                 => $this->faker->numerify('0#-####-####'),
            'fax'                   => $this->faker->numerify('0#-####-####'),
            'mobile'                => $this->faker->numerify('0#-####-####'),
            'email'                 => $this->faker->safeEmail(),
            'practice_name'         => $this->faker->name(),
        ];
    }
}
