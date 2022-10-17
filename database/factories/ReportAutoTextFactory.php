<?php

namespace Database\Factories;

use App\Models\ReportSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReportAutoText>
 */
class ReportAutoTextFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'section_id'    => ReportSection::inRandomOrder()->first()->id,
            'text'          => $this->faker->sentence(rand(3,5)),
            'icd_10_code'   =>$this->faker->randomElement([
                'A04.71 - Enterocolitis due to Colostridium',
                'H70.00 - Acute mastoiditis without complications',
                'H70.02 - Petrositis',
                'H70.08 - Other mastoiditis and related conditions',
                'H70.09 - Unspecified mastoiditis',
                'P08.00 - Disorders of newborn related to long gestation and high birth weight']),
        ];
    }
}
