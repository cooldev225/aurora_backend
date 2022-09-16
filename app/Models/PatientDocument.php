<?php

namespace App\Models;

use Carbon\Carbon;
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

    protected $appends = [
        'document_info'
    ];

    public function getDocumentInfoAttribute(){
        return [
            'patient' => $this->patient->full_name . ' (' . Carbon::parse($this->patient->date_of_birth)->format('d-m-Y'). ')',
            'specialist' => $this->specialist->full_name,
            'appointment' => $this->appointment->aus_formatted_date . ' ' . $this->appointment->formatted_appointment_time . ' @ ' . $this->appointment->clinic->name,
        ];
    }

    /**
     * Return Patient
     */
    public function patient()
    {
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
    public function specialist()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return Appointment
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
