<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientRecall extends Model
{
    use HasFactory;

    protected $fillable = [
        'specialist_id',
        'organization_id',
        'patient_id',
        'appointment_id',
        'notification_template_id',
        'recalled_text',
        'recall_sent_date',
        'recall_note',
        'appointment_date',
        'status',
        'sent_by',
    ];
}
