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

    /**
     * Return Appointment
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function updateReferralData($data) {
        $this->referring_doctor_id = $data['referring_doctor_id'];
        $this->referral_date = $data['referral_date'];
        $this->referral_duration = $data['referral_duration'];
        $this->referral_expiry_date = date(
            "Y-m-d", strtotime(
                "+" . $this->referral_duration . " months",
                strtotime($this->referral_date)
            )
        );

        $this->save();
    }
}
