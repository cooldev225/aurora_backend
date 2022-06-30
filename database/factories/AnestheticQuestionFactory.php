<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Organization;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AnestheticQuestion>
 */
class AnestheticQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $organization_id = Organization::inRandomOrder()->first()->id;

        return [
            'organization_id' => $organization_id,
            'question' => $this->faker->sentence(),
        ];
    }
}
