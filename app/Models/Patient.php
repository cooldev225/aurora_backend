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
        'int_contact_number',
        'active_alerts',
    );

    public function getActiveAlertsAttribute()
    {
        return $this->alerts->where('is_dismissed', 0);
    }


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
        return $this->billing()->get(); 
    }


    /**
     * Return Patient Billing
     */
    public function billing()
    {
        return $this->hasOne(PatientBilling::class, 'patient_id');
    }

    /**
     * Return Patient Appointment
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id')
        ->with('appointment_type')
        ->with('referral')
        ->where('organization_id', auth()->user()->organization_id)
        ->orderBy('date', 'DESC')
        ->orderBy('start_time', 'DESC');;
    }

    /**
     * Return Patient Appointment
     */
    public function allergies()
    {
        return $this->hasMany(PatientAllergy::class);
    }

    /**
     * Return Patient alerts
     */
    public function alerts()
    {
        return $this->hasMany(PatientAlert::class);
    }


    /**
     * Returns Patients Upcoming Appointment
     */
    public function upcoming_appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id')
        ->where('date', '>=', date('Y-m-d'))
        ->with('appointment_type');
    }

    /**
     * Return Patient Recalls
     */
    public function recalls()
    {
        return $this->hasMany(PatientRecall::class, 'patient_id');
    }

    /**
     * Return Patient documents
     */
    public function documents()
    {
        return $this->hasMany(PatientDocument::class);
    }

    /**
     * Get the patients for organization.
     */
    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }

    public function isPartOfOrganization($organization_id){
        return $this->organizations()->where('organization_id', $organization_id)->exists();
    }
}