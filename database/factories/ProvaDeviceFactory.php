<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProvaDevice>
 */
class ProvaDeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'device_name' => $this->faker->username(),
            'otac' => $this->faker->username(),
            'private_key' => Str::random(683),
            'public_key' => Str::random(683),
            'key_expiry' => $this->faker->date(),
            'device_expiry' => $this->faker->date(),
        ];
    }
}
