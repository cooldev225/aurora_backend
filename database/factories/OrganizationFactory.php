<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\UserRole;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $owner = User::factory()->create([
            'role_id' => UserRole::where('slug', 'organizationAdmin')->first()
                ->id,
        ]);

        return [
            'name'                   => $this->faker->company(),
            'logo'                   => $this->faker->imageUrl(),
            'max_clinics'            => mt_rand(1, 9999),
            'max_employees'          => mt_rand(1, 9999),
            'owner_id'               => $owner->id,
            'appointment_length'     => $this->faker->randomElement([30, 15, 60]),
            'start_time'             => $this->faker->randomElement(['06:00', '07:00', '08:00']),
            'end_time'               => $this->faker->randomElement(['18:00', '19:00', '20:00']),
            'document_letter_header' => $this->faker->imageUrl(),
            'document_letter_footer' => $this->faker->imageUrl(),

            'has_billing'            => $this->faker->boolean(),
            'has_coding'             => $this->faker->boolean(),
        ];
    }
}
