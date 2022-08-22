<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'first_name', 'last_name', 'email', 'contact_number',
        'gender', 'date_of_birth', 'address', 'street', 'suburb',
        'city', 'state', 'postcode', 'country', 'marital_status',
        'birth_place_code', 'country_of_birth', 'birth_state',
        'allergies', 'aborginality', 'occupation', 'height', 'weight',
        'bmi', 'preferred_contact_method', 'appointment_confirm_method',
        'send_recall_method', 'kin_name', 'kin_relationship',
        'kin_phone_number', 'clinical_alert',
    ];

    protected $appends = array(
        'full_name',
        'billing',
        'all_upcoming_appointments',
        'five_previous_appointments',
        'previous_appointment_count',
        'int_contact_number'
    );

    public function getIntContactNumberAttribute()
    {
        return '+61' . substr($this->contact_number, 1);  
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;  
    }

    public function getBillingAttribute()
    {
        return $this->billing(); 
    }

    public function getAllUpcomingAppointmentsAttribute()
    {
        $organization_id = auth()->user()->organization_id;

        return $this->appointments()
            ->where('organization_id', $organization_id)
            ->where('date', '>=', date('Y-m-d'))
            ->get();
    }

    public function getFivePreviousAppointmentsAttribute()
    {
        $organization_id = auth()->user()->organization_id;

        return $this->appointments()
            ->where('organization_id', $organization_id)
            ->where('date', '<', date('Y-m-d'))
            ->take(5)
            ->get();  
    }
    public function getPreviousAppointmentCountAttribute()
    {
        $organization_id = auth()->user()->organization_id;

        return $this->appointments()
            ->where('organization_id', $organization_id)
            ->where('date','<', date('Y-m-d'))
            ->count();  
    }
    /**
     * Return Patients' Organization
     */
    public function patientOrganization($organization_id)
    {
        return $this->hasMany(PatientOrganization::class)
            ->where('organization_id', $organization_id)
            ->first();
    }

    /**
     * Return Patient Billing
     */
    public function billing()
    {
        return $this->hasOne(PatientBilling::class, 'patient_id')->first();
    }

    /**
     * Return Patient Appointment
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    /**
     * Get the patients for organization.
     */
    public function organizations()
    {
        return $this->belongsToMany(Organization::class,'organization_patient');
    }
}