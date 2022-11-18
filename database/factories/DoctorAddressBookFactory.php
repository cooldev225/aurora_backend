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
            'organization_id'       => '1',
            'provider_no'           => $this->faker->bothify('#######?'),
            'title'                 => $this->faker->title(),
            'first_name'            => $this->faker->firstName(),
            'last_name'             => $this->faker->lastName(),
            'practice_address'      => $this->faker->address(),
            'practice_phone'        => $this->faker->numerify('0#-####-####'),
            'practice_fax'          => $this->faker->numerify('0#-####-####'),
            'practice_email'        => $this->faker->safeEmail(),
            'practice_name'         => $this->faker->name(),
        ];
    }
}
