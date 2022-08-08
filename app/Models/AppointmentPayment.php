<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id', 'confirmed_by', 'amount', 'payment_type'
    ];
    
    /**
     * Return Appointment
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

  

public function getCreatedAtAttribute($value)
{
    return Carbon::parse($value)->format('Y-m-d H:i');
}
}
