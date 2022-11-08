<?php

namespace App\Models;

use App\Mail\GenericNotificationEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PatientRecall extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'organization_id',
        'appointment_id',
        'patient_id',
        'time_frame',
        'date_recall_due',
        'confirmed',
        'reason',
    ];

    protected $appends = [
        'summery'
    ];

    public function getSummeryAttribute(){
        return [
            'patient_name' => $this->patient->full_name,
            'patient_contact_number' => $this->patient->contact_number,
            'specialist_name' => $this->user->full_name,
            'appointment_type' => $this->appointment->appointment_type->name,
            'appointment_clinic' => $this->appointment->clinic->name,
            'appointment_date' => $this->appointment->aus_formatted_date,
        ];
    }

    /**
     * Return Patient
     */
    public function sentLogs()
    {
        return $this->hasMany(PatientRecallSentLog::class);
    }

    /**
     * Return Patient
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

      /**
     * Return Patient
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Return User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    /**
     * Return Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }


    public function translate($template,) {
        $words = [
            '[PatientFirstName]'    => $this->first_name,
        ];

        $translated = $template;

        foreach ($words as $key => $word) {
            $translated = str_replace($key, $word, $translated);
        }

        return $translated;
    }

    public function sendNotification(){
        $channel = $this->patient->appointment_confirm_method;
     

        $notificationTemplate = NotificationTemplate::where('type', 'recall')
            ->where('organization_id', $this->organization_id)
            ->first();

        $template = $channel == 'SMS' ? $notificationTemplate->sms_template : $notificationTemplate->email_print_template;

        $data = [
            'subject' => $notificationTemplate->subject,
            'message' => $this->translate($template),
        ];

        if ($channel == 'sms') {
            $this->patient->sendSms($data['message']);
        } elseif ($channel == 'email') {
            $this->patient->sendEmail(new GenericNotificationEmail($data['subject'], $data['message']));
        }
    }

}
