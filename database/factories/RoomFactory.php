<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Organization;
use App\Models\Clinic;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'organization_id' => Organization::inRandomOrder()->first()->id,
            'clinic_id' => Clinic::inRandomOrder()->first()->id,
            'name' => $this->faker->title(),
        ];
    }
}
