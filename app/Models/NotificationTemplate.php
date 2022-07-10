<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'type',
        'days_before',
        'subject',
        'sms_template',
        'email_print_template',
        'status',
    ];

    /**
     * translate SMS template
     */
    public function translateSms()
    {
        return $this->translate($this->sms_template);
    }

    /**
     * translate Email template
     */
    public function translateEmail()
    {
        return $this->translate($this->email_print_template);
    }

    /**
     * translate Print template
     */
    public function translatePrint()
    {
        return $this->translate($this->email_print_template);
    }

    /**
     * translate template
     */
    protected function translate($template)
    {
        $words = [
            '[PatientFirstName]' => $appointment->patient()->first_name,
            '[Time]' => $appointment->start_time,
            '[Date]' => $appointment->date,
            '[ClinicName]' => $appointment->clinic()->name,
        ];

        $translated = $template;

        foreach ($words as $key => $word) {
            $translated = str_replace($key, $word, $translated);
        }

        return $translated;
    }
}
