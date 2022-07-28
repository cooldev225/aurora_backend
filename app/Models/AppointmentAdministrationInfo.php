<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentAdministrationInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'referring_doctor_id',
        'is_no_referral',
        'no_referral_reason',
        'note',
        'important_details',
        'clinical_alerts',
        'receive_forms',
        'recurring_appointment',
        'recent_service',
        'outstanding_balance',
        'further_details',
        'fax_comment',
        'anything_should_aware',
        'collecting_person_name',
        'collecting_person_phone',
        'collecting_person_alternate_contact',
    ];

    /**
     * Return Appointment
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id')->first();
    }
}
