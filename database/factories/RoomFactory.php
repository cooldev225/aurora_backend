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
        $clinic = Clinic::inRandomOrder()->first();

        return [
            'organization_id' => $clinic->organization_id,
            'clinic_id' => $clinic->id,
            'name' => $this->faker->catchPhrase(),
        ];
    }
}
