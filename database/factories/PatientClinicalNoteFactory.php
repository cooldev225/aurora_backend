<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\PatientDocument;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientClinicalNote>
 */
class PatientClinicalNoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $appointment = Appointment::inRandomOrder()->first();
        $appointment_id = $appointment->id;
        $patient_id = $appointment->patient_id;
        $specialist_id = $appointment->specialist_id;
        $organization_id = $appointment->organization_id;
        $user = User::where('organization_id', $organization_id)
            ->inRandomOrder()
            ->first();
        $created_by = $user->id;
        $file_path = $this->faker->imageUrl();

        $patient_document = PatientDocument::create([
            'patient_id'        =>  $patient_id,
            'document_name'     =>  $this->faker->word(),
            'appointment_id'    =>  $appointment_id,
            'specialist_id'     =>  $specialist_id,
            'document_type'     =>  'CLINICAL_NOTE',
            'created_by'        =>  $created_by,
            'file_path'         =>  $file_path,
            'is_updatable'      =>  true,
        ]);

        return [
            'patient_document_id'   =>  $patient_document->id,
            'appointment_id'        =>  $appointment_id,

            'description'           => $this->faker->text(),
            'diagnosis'             => $this->faker->text(),
            'clinical_assessment'   => $this->faker->text(),
            'treatment'             => $this->faker->text(),
            'history'               => $this->faker->text(),
            'additional_details'    => $this->faker->text(),
            'attached_documents'    => $this->faker->text(),
        ];
    }
}
