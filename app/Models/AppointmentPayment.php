<?php

namespace App\Models;

use App\Mail\Notification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id', 'confirmed_by', 'amount', 'payment_type',
        'is_deposit'
    ];

    protected $appends = [
        'confirmed_user_name'
    ];
    
    public function getConfirmedUserNameAttribute()
    {
        return $this->confirmed_user->first_name .' '. $this->confirmed_user->last_name;
    }


    /**
     * Return Appointment
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    /**
     * Return Appointment
     */
    public function confirmed_user()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    public static function create(array $attributes = []) {
        $payment = static::query()->create($attributes);
        Notification::sendPaymentNotification($payment, 'payment_made');

        return $payment;
    }

    /**
     * translate template
     */
    public function translate($template, $data)
    {
        $appointment = $this->appointment;
        $patient = $appointment->patient();
        $clinic = $appointment->clinic;

        $patient_name = $patient->title . ' ' . $patient->first_name . ' ' . $patient->last_name;
        $clinic_name = $clinic->name;

        $words = [
            '[patient]'                     => $patient_name,       ///
            '[amount]'                      => $this->amount,
            '[clinic_name]'                 => $clinic_name,        ///
            '[total_amount]'                => '',
            '[amount_paid]'                 => '',
            '[amount_outstanding]'          => '',
            '[user_who_took_the_payment]'   => '',
        ];
        

        $translated = $template;

        foreach ($words as $key => $word) {
            $translated = str_replace($key, $word, $translated);
        }

        return $translated;
    }

}