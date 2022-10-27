<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentReferral extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'doctor_address_book_id',
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
     * Return Doctor Address Book
     */
    public function doctor_address_book()
    {
        return $this->belongsTo(DoctorAddressBook::class);
    }

    public function getReferringDoctorNameAttribute()
    {
        $doctor_address_book = $this->doctor_address_book;
        return $doctor_address_book ? $doctor_address_book->full_name : null;
    }
}
