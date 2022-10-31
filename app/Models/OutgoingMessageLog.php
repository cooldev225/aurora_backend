<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingMessageLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id', 
        'patient_id',
        'message_contents',
        'sending_user',
        'sending_doctor_user',
        'send_method', 
        'send_status',
        'sending_doctor_name',
        'sending_doctor_provider',
        'receiving_doctor_name',
        'receiving_doctor_provider'
    ];

    /**
     * Return Patient that the outgoing belongs to
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
