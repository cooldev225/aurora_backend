<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientClinicalNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_document_id', 'appointment_id', 'description', 'diagnosis',
        'clinical_assessment', 'treatment', 'history', 'additional_details',
        'attached_documents'
    ];

    /**
     * Return Patient Document
     */
    public function patient_document()
    {
        return $this->belongsTo(PatientDocument::class);
    }

    /**
     * Return Patient
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Return Specialist
     */
    public function specialist()
    {
        return $this->belongsTo(Specialist::class);
    }

    /**
     * Return Appointment
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Return Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function generatePDFFile() {
        ////////////////////////////////////////////////////////////////////////
        // Generate PDF
        $file_path = '';

        $patient_document = $this->patient_document;
        $patient_document->file_type = 'PDF';
        $patient_document->file_path = $file_path;
        $patient_document->save();
    }
}
