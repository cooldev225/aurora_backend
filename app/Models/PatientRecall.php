<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PatientRecall extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'organization_id',
        'patient_id',
        'time_frame',
        'date_recall_due',
        'confirmed',
        'reason',
    ];

    protected $appends = [
        'summery'
    ];

    public function getSummeryAttribute(){
        return [
            'patient_name' => $this->patient->full_name,
            'patient_contact_number' => $this->patient->contact_number,
            'specialist_name' => $this->user->full_name,
            'appointment_type' => $this->appointment->appointment_type->name,
            'appointment_clinic' => $this->appointment->clinic->name,
            'appointment_date' => $this->appointment->aus_formatted_date,
        ];
    }

    /**
     * Return Patient
     */
    public function sentLogs()
    {
        return $this->hasMany(PatientRecallSentLog::class);
    }

    /**
     * Return Patient
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

      /**
     * Return Patient
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Return User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    /**
     * Return Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

}
