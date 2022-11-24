<?php

namespace Database\Factories;

use App\Enum\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
            'role_id' => UserRole::ORGANIZATION_ADMIN,
        ]);
$name=  $this->faker->company();
        return [
            'name'                   => $name,
            'code'                   => substr($name, 0, 3),
            'max_clinics'            => mt_rand(1, 9999),
            'max_employees'          => mt_rand(1, 9999),
            'owner_id'               => $owner->id,
            'appointment_length'     => $this->faker->randomElement([30, 15, 60]),
            'start_time'             => $this->faker->randomElement(['06:00', '07:00', '08:00']),
            'end_time'               => $this->faker->randomElement(['18:00', '19:00', '20:00']),
            'has_billing'            => $this->faker->boolean(),
            'has_coding'             => $this->faker->boolean(),
            'abn_acn'                => $this->faker->randomNumber(5) . $this->faker->randomNumber($this->faker->randomElement([4, 6])),

            'password_expiration_timeframe'=> 6,
        ];
    }
}
