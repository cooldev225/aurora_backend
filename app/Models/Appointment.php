<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'organization_id',
        'clinic_id',
        'appointment_type_id',
        'primary_pathologist_id',
        'specialist_id',
        'room_id',
        'anesthetist_id',
        'reference_number',
        'is_waitlisted',
        'procedure_approval_status',
        'confirmation_status',
        'attendance_status',
        'date',
        'arrival_time',
        'start_time',
        'end_time',
        'actual_arrival_time',
        'actual_start_time',
        'actual_end_time',
        'charge_type',
        'payment_status',
        'skip_coding',
    ];
}
