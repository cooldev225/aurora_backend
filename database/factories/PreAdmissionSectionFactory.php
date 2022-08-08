<?php

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PreAdmissionSection>
 */
class PreAdmissionSectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'organization_id'   => Organization::inRandomOrder()->first()->id,
            'title'             => $this->faker->sentence(),
        ];
    }
}
