<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentPreAdmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id', 'token', 'status'
    ];

    public function appointment() {
        return $this->belongsTo(Appointment::class);
    }

    public function getAppointmentPreAdmissionData() {
        $appointment = $this->appointment;
        $organization = $appointment->organization;
        $data = [
            'organization_logo' =>  $organization->logo,
            'status'            =>  $this->status
        ];
        
        if ($this->status == 'BOOKED') {
            return $data;
        }

        $patient = $appointment->patient();
        $data['patient'] = $patient;

        return $data;
    }
}
