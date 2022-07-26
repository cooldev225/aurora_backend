<?php

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScheduleFee>
 */
class ScheduleFeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'organization_id'           => Organization::inRandomOrder()->first()->id,
            'allow_zero'                => false,
            'item_number'               => mt_rand(100, 200),
            'medicare_fee'              => $this->faker->randomFloat(2, 100, 800),
            'medicare_fee_75'           => $this->faker->randomFloat(2, 100, 800),
            'medicare_fee_85'           => $this->faker->randomFloat(2, 100, 800),
            'procedure_or_consultation' => $this->faker->word(),
            'dva_in'                    => $this->faker->randomFloat(2, 100, 800),
            'dva_out'                   => $this->faker->randomFloat(2, 100, 800),
            'tac'                       => $this->faker->randomFloat(2, 100, 800),
            'work_cover'                => $this->faker->randomFloat(2, 100, 800),
        ];
    }
}
