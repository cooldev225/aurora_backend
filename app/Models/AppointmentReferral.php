<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentReferral extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'referring_doctor_id',
        'is_no_referral',
        'no_referral_reason',
        'referral_date',
        'referral_duration',
        'referral_expiry_date',
        'referral_file',
    ];

    protected $appends = [
        'referring_doctor_name'
    ];

    /**
     * Return Appointment
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Return Referring Doctor
     */
    public function referring_doctor()
    {
        return $this->belongsTo(ReferringDoctor::class);
    }

    public function getReferringDoctorNameAttribute()
    {
        $referring_doctor = $this->referring_doctor;
        return $referring_doctor ? $referring_doctor->full_name : null;
    }
}
