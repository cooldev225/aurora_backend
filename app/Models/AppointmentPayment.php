<?php

namespace App\Models;

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

    /**
     * Formate Create Date
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y H:i');
    }
}