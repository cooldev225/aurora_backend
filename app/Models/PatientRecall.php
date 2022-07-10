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
        'recall_date',
        'recall_note',
        'appointment_date',
        'status',
        'sent_by',
    ];

    /**
     * Return Patient
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id')->first();
    }

    /**
     * Return NotificationTemplate
     */
    public function notificationTemplate()
    {
        return $this->belongsTo(
            NotificationTemplate::class,
            'notification_template_id'
        )->first();
    }

    /**
     * Send Recall Message to Patient
     */
    public function sendRecall()
    {
        $patient = $this->patient();
        $notification_template = $this->notificationTemplate();
    }
}
