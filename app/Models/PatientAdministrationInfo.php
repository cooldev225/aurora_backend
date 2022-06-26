<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAdministrationInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'appointment_id',
        'referring_doctor_id',
        'is_no_referral',
        'no_referral_reason',
        'referal_date',
        'referal_expiry_date',
        'note',
        'important_details',
        'allergies',
        'clinical_alerts',
        'appointment_confirm',
        'receive_forms',
        'recurring_appointment',
        'preferred_contact_method',
        'aborginality',
        'occupation',
        'recent_service',
        'outstanding_balance',
        'further_details',
        'fax_comment',
        'anything_should_aware',
        'collecting_person_name',
        'collecting_person_phone',
        'collecting_person_alternate_contact',
    ];
}
