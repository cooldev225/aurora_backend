<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentPreAdmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id', 'token', 'note', 'status'
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
        $specialist = $appointment->specialist();
        $employee = $specialist->employee();
        $user = $employee->user();

        $data['patient'] = $patient;
        $data['appointment'] = $appointment;
        $data['clinic'] = $appointment->clinic;
        $data['appointment_type'] = $appointment->type();
        $data['specialist_user'] = $user;

        $data['pre_admission_sections'] = PreAdmissionSection::where(
                'organization_id', $organization->id
            )
            ->with('questions')
            ->get();

        $data['pre_admission_consent'] = PreAdmissionConsent::where(
                'organization_id', $organization->id
            )
            ->first();

        return $data;
    }
}
