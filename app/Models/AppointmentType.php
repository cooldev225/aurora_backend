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
        'anesthetist_required',
        'status',
        'report_template',
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
