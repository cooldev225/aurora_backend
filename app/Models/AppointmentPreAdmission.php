<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AppointmentPreAdmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id', 'token', 'note', 'status'
    ];

    protected $appends = ['document_url'];

    public function appointment() {
        return $this->belongsTo(Appointment::class);
    }

    public function getAppointmentPreAdmissionData() {

        $appointment = $this->appointment;
        $organization = $appointment->organization;
        $data = [
            'organization_logo'     =>  $organization->logo,
            'status'                =>  $this->status,
            'note'                  =>  $this->note,
            'pre_admission_file'    =>  $this->pre_admission_file
        ];
        
        if ($this->status == 'BOOKED') {
            return $data;
        }

        $patient = $appointment->patient;



        $data['patient'] = $patient;
        $data['appointment'] = $appointment;
        $data['clinic'] = $appointment->clinic;
        $data['appointment_type'] = $appointment->type;

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

    public function getDocumentUrlAttribute()
    {
        if ($this->pre_admission_file) {
            if (config('filesystems.default') !== 's3') {
                return url($this->pre_admission_file);
            }

            $expiry = config('temporary_url_expiry');
            return Storage::temporaryUrl($this->pre_admission_file, now()->addMinutes($expiry));
        }
    }
}
