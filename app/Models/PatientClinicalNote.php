<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientClinicalNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 'specialist_id', 'appointment_id', 'organization_id',
        'description', 'diagnosis', 'clinical_assessment', 'treatment',
        'history', 'additional_details', 'attached_documents'
    ];

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
}
