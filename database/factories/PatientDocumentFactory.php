<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientSpecialistAudio>
 */
class PatientDocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'document_name'     =>  $this->faker->word(),
            'document_type'     =>  $this->faker->randomElement(['LETTER', 'REPORT', 'CLINICAL_NOTE','PATHOLOGY_REPORT','OTHER']),
            'created_by'        =>  0,
            'file_path'         =>  $this->faker->numberBetween(1, 5).'.pdf',
            'is_updatable'      =>  false,
            'file_type'         =>  'PDF',
        ];
    
    }
}
