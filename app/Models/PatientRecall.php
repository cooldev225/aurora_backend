<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientRecall extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'organization_id',
        'patient_id',
        'time_frame',
        'date_recall_due',
        'confirmed',
        'reason',
    ];

    /**
     * Return Patient
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
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

        $translated_message = $notification_template->translate($this);

        $this->recalled_text = $translated_message;

        $patient_recall_sent_log = new PatientRecallSentLog();
        $patient_recall_sent_log->patient_recall_id = $this->id;
        $patient_recall_sent_log->recall_sent_at = date('Y-m-d H:i:s');
        $patient_recall_sent_log->sent_by = $this->send_by;

        $patient_recall_sent_log->save();
    }
}
