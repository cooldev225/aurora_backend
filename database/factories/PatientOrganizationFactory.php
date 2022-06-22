<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Patient;
use App\Models\Organization;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientOrganization>
 */
class PatientOrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'organization_id' => Organization::inRandomOrder()
                ->limit(1)
                ->get()[0]->id,
            'patient_id' => Patient::inRandomOrder()
                ->limit(1)
                ->get()[0]->id,
        ];
    }
}
