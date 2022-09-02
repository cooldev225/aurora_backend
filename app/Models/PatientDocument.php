<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id', 'document_name', 'appointment_id', 'specialist_id',
        'document_type', 'created_by', 'file_path', 'is_updatable',
        'origin'
    ];

    /**
     * Return Patient
     */
    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the user action logs for this document.
     */
    public function action_logs()
    {
        return $this->hasMany(PatientDocumentsActionLog::class);
    }

    /**
     * Return Specialist
     */
    public function specialist() {
        return $this->belongsTo(Specialist::class);
    }

    /**
     * Return Appointment
     */
    public function appointment() {
        return $this->belongsTo(Appointment::class);
    }


}
