<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'type',
        'color',
        'mbs_code',
        'mbs_description',
        'clinical_code',
        'name',
        'invoice_by',
        'arrival_time',
        'appointment_time',
        'payment_tier_1',
        'payment_tier_2',
        'payment_tier_3',
        'payment_tier_4',
        'payment_tier_5',
        'payment_tier_6',
        'payment_tier_7',
        'payment_tier_8',
        'payment_tier_9',
        'payment_tier_10',
        'payment_tier_11',
        'anesthetist_required',
        'status',
    ];

    protected $appends = [
        'appointment_length_as_number'
    ];

        /**
     * Return the appointment_time attribute as a number
     */
    public function getAppointmentLengthAsNumberAttribute()
    {
        if ($this->appointment_time == 'SINGLE') {
            return 1;
        } else if ($this->appointment_time == 'DOUBLE') {
            return 2;
        }else{
            return 3;
        }
    }

    /**
     * Return Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
