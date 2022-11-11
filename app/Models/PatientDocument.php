<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id', 'document_name', 'appointment_id', 'specialist_id', 'file_type',
        'document_type','document_body', 'created_by', 'file_path', 'is_updatable',
        'origin', 'organization_id', 'is_read','is_urgent', 'is_incorrectly_assigned'
    ];

    protected $appends = [
        'document_info',
        'document_url',
    ];

    public function getDocumentInfoAttribute(){
        return [
            'patient' => $this->patient ? $this->patient->full_name . ' (' . Carbon::parse($this->patient->date_of_birth)->format('d-m-Y'). ')' : '',
            'specialist' => $this->specialist?->full_name,
            'appointment' =>  $this->appointment ? $this->appointment->aus_formatted_date . ' ' . $this->appointment->formatted_appointment_time . ' @ ' . $this->appointment->clinic->name : '',
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

    public function getDocumentUrlAttribute()
    {
        if ($this->file_path) {
            $expiry = config('temporary_url_expiry');
            return Storage::temporaryUrl($this->file_path, now()->addMinutes($expiry));
        }
    }
}
