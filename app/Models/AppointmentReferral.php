<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'patient_document_id',
    ];

    protected $appends = [
        'doctor_address_book_name',
        'patient_document_file_path',
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

    /**
     * Return Patient Document
     */
    public function patient_document()
    {
        return $this->belongsTo(PatientDocument::class);
    }

    public function getDoctorAddressBookNameAttribute()
    {
        $doctor_address_book = $this->doctor_address_book;
        return $doctor_address_book ? $doctor_address_book->full_name : null;
    }

    public function getPatientDocumentFilePathAttribute()
    {
        return $this->patient_document?->file_path;   
    }
}
