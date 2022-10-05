<?php

namespace App\Models;

use App\Mail\Notification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 'organization_id', 'clinic_id', 'appointment_type_id',
        'specialist_id', 'room_id', 'anesthetist_id', 'is_wait_listed',
        'procedure_approval_status', 'confirmation_status', 'attendance_status',
        'date', 'arrival_time', 'start_time', 'end_time', 'charge_type',
        'note', 'collecting_person_name', 'collecting_person_phone',
        'collecting_person_alternate_contact',
    ];
    protected $appends = [
        'patient_name', 'patient_details', 'specialist_name','appointment_type_name',
        'aus_formatted_date', 'formatted_appointment_time',
        'is_pre_admission_form_complete', 'clinic_details'
    ];


    public function getAusFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->format('d/m/Y'); 
    }

    public function getAppointmentTypeNameAttribute()
    {
        return $this->appointment_type->name; 
    }

    public function getFormattedAppointmentTimeAttribute()
    {
        $start = Carbon::parse($this->start_time)->format('H:i');
        $end = Carbon::parse($this->end_time)->format('H:i');
        return $start . "-" . $end; 
    }

    public function getSpecialistNameAttribute()
    {
        return $this->specialist->title .' '. $this->specialist->first_name .' '. $this->specialist->last_name;  
    }

    public function getClinicDetailsAttribute()
    {   
        return [
            'name' => $this->clinic->name,
        ];
    }

    public function getPatientNameAttribute() {
        $patient = $this->patient;
        return [
            'full' => $patient->title .' ' . $patient->first_name .' '.$patient->last_name,
            'first'=> $patient->first_name,
            'last' => $patient->last_name
        ];
    }

    public function getPatientDetailsAttribute() {
        $patient = $this->patient;
        return [
            'date_of_birth' => Carbon::parse( $patient ->date_of_birth)->format('d-m-Y'),
            'contact_number'=>  $patient ->contact_number,
            'email'=>  $patient ->email,
      ];
    }

    public function getIsPreAdmissionFormCompleteAttribute() {
        if($this->pre_admission->pre_admission_file){
            return true;
        }
        return false;
    }


    /**
     * Return Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Return Organization
     */
    public function codes()
    {
        return $this->hasOne(AppointmentCodes::class);
    }

    /**
     * Return Organization
     */
    public function documents()
    {
        return $this->hasMany(PatientDocument::class);
    }


    /**
     * Return Patient that the appointment belongs to
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Return Clinic
     */
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    /**
     * Return Appointment Type
     */
    public function appointment_type()
    {
        return $this->belongsTo(AppointmentType::class);
    }

     /**
     * Return AppointmentReferral
     */
    public function referral()
    {
        return $this->hasOne(AppointmentReferral::class);
    }
    
    /**
     * Return Return Payments
     */
    public function payments()
    {
        return $this->hasMany(AppointmentPayment::class);
    }

    /**
     * Return Pre Admission
     */
    public function pre_admission()
    {
        return $this->hasOne(AppointmentPreAdmission::class);
    }

    /**
     * Return Room
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function specialist()
    {
        return $this->hasOne(User::class, 'id','specialist_id');
    }

    public function anesthetist()
    {
        return $this->hasOne(User::class,'id', 'anesthetist_id');
    }
    
    /**
     * Check conflict
     */
    public function checkConflict($start_time, $end_time)
    {
        if ($this->start_time >= $end_time) {
            return false;
        }

        if ($this->end_time <= $start_time) {
            return false;
        }

        return true;
    }

  
}
