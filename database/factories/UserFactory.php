<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\UserRole;
use App\Models\Organization;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $organization = Organization::inRandomOrder()->first();

        if (empty($organization)) {
            $organization_id = 0;
        } else {
            $organization_id = $organization->id;
        }

        $user_name = $this->faker->unique()->username();
        $role_id = UserRole::inRandomOrder()->first()->id;

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'username' => $user_name,
            'role_id' => $role_id,
            'email' => $this->faker->unique()->safeEmail(),
            'mobile_number' => $this->faker->phoneNumber(),
            'date_of_birth' => $this->faker->date(),
            'email_verified_at' => now(),
            'password' => Hash::make('Paxxw0rd'),
            'remember_token' => Str::random(10),
            'organization_id' => $organization_id,
            'address' => $this->faker->address(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
