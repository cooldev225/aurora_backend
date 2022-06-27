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
        'procedure_id',
        'primary_pathologist_id',
        'specialist_id',
        'room_id',
        'anaethetist_id',
        'reference_number',
        'status',
        'checkin_status',
        'date',
        'start_time',
        'end_time',
        'actual_start_time',
        'actual_end_time',
        'payment_status',
    ];
}
