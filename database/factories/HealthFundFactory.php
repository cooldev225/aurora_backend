<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HealthFund>
 */
class HealthFundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'code' => Str::random(6),
            'fund' => mt_rand(12345, 912345) . 'AUD',
            'contact' => $this->faker->phoneNumber(),
            'issues' => $this->faker->text(),
        ];
    }
}
