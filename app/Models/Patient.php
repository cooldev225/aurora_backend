<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'email',
        'contact_number',
        'gender',
        'date_of_birth',
        'address',
        'street',
        'suburb',
        'city',
        'state',
        'postcode',
        'country',
        'marital_status',
        'birth_place_code',
        'country_of_birth',
        'birth_state',
        'allergies',
        'aborginality',
        'occupation',
        'height',
        'weight',
        'bmi',
        'preferred_contact_method',
        'appointment_confirm_method',
        'send_recall_method',
        'kin_name',
        'kin_relationship',
        'kin_phone_number',
        'clinical_alert',
    ];

    protected $appends = array('full_name','billing','all_upcoming_appointments','five_previous_appointments','previous_appointment_count');

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
        return $this->appointments()->where('date', '>=', date('Y-m-d'))->get();
    }

    public function getFivePreviousAppointmentsAttribute()
    {
        return $this->appointments()->where('date', '<', date('Y-m-d'))->take(5)->get();  
    }
    public function getPreviousAppointmentCountAttribute()
    {
        return $this->appointments()->where('date','<', date('Y-m-d'))->count();  
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

    public function getAppointmentsWithSpecialist() {
        $patient_id = $this->id;

        $appointment_table = (new Appointment())->getTable();
        $appointment_type_table = (new AppointmentType())->getTable();
        $appointment_administration_info_table = (new AppointmentAdministrationInfo())->getTable();
        $specialist_table = (new Specialist())->getTable();
        $employee_table = (new Employee())->getTable();
        $user_table = (new User())->getTable();
        $clinic_table = (new Clinic())->getTable();
        $specialist_title_table = (new SpecialistTitle())->getTable();

        return Appointment::select(
                $appointment_table . '.*',
                $appointment_administration_info_table . '.*',
                DB::raw('CONCAT(' . $specialist_title_table . '.name, " ",'
                    . $user_table . '.first_name, " ",'
                    . $user_table . '.last_name) AS specialist_name'),
                $appointment_type_table  . '.name AS appointment_type_name',
                $clinic_table  . '.name AS clinic_name',
                $clinic_table  . '.hospital_provider_number AS specialist_provider_name'
            )
            ->leftJoin(
                $appointment_type_table,
                $appointment_table . '.appointment_type_id',
                $appointment_type_table . '.id'
            )
            ->leftJoin(
                $appointment_administration_info_table,
                'appointment_id',
                '=',
                "{$appointment_table}.id"
            )
            ->leftJoin(
                $specialist_table,
                $appointment_table . '.specialist_id',
                $specialist_table . '.id'
            )
            ->leftJoin(
                $specialist_title_table,
                'specialist_title_id',
                $specialist_title_table . '.id'
            )
            ->leftJoin(
                $employee_table,
                $specialist_table . '.employee_id',
                $employee_table . '.id'
            )
            ->leftJoin(
                $user_table,
                $employee_table . '.user_id',
                $user_table . '.id'
            )
            ->leftJoin(
                $clinic_table,
                $appointment_table . '.clinic_id',
                $clinic_table . '.id'
            )
            ->where('patient_id', $patient_id)
            ->orderBy('date', 'DESC')
            ->orderBy('start_time', 'DESC')
            ->get();
    }

    
    /**
     * Return patient list for organization
     */
    public static function organizationPatientsBasicInfo($organization_id = null)
    {
        if ($organization_id == null) {
            $organization_id = auth()->user()->organization_id;
        }

        $organization_table = (new Organization())->getTable();
        $patient_table = (new Patient())->getTable();

        return PatientOrganization::select($patient_table . '.id',
                $patient_table . '.first_name',
                $patient_table . '.last_name',
                $patient_table . '.email',
                $patient_table . '.address',
                $patient_table . '.date_of_birth',
                $patient_table . '.contact_number'
            )
            ->leftJoin(
                $organization_table,
                'organization_id',
                '=',
                $organization_table . '.id'
            )
            ->leftJoin(
                $patient_table,
                'patient_id',
                '=',
                $patient_table . '.id'
            )
            ->where('organization_id', $organization_id);
    }

    /**
     * Return patient list for organization
     */
    public static function patientDetailInfo($patient_id)
    {
        $organization_table = (new Organization())->getTable();
        $patient_organization_table = (new PatientOrganization())->getTable();
        $patient_table = (new Patient())->getTable();
        $patient_billing_table = (new PatientBilling())->getTable();

        return Patient::find($patient_id)
            ->leftJoin(
                $patient_organization_table,
                $patient_organization_table . '.patient_id',
                '=',
                $patient_table . '.id'
            )
            ->leftJoin(
                $organization_table,
                $patient_organization_table . '.organization_id',
                '=',
                $organization_table . '.id'
            )
            ->leftJoin(
                $patient_billing_table,
                $patient_billing_table . ".patient_id",
                '=',
                $patient_table . ".id"
            )
            ->where($patient_table . ".id", $patient_id);
    }

    private static function patientAppointmentsQueryBuilder($patient_id) {
        $appointment_table = (new Appointment())->getTable();
        $appointment_type_table = (new AppointmentType())->getTable();
        $specialist_table = (new Specialist())->getTable();
        $employee_table = (new Employee())->getTable();
        $user_table = (new User())->getTable();
        $specialist_title_table = (new SpecialistTitle())->getTable();

        return Appointment::
            select(
                $appointment_table . '.*',
                DB::raw(
                    "CONCAT(" . $specialist_title_table . ".name, ' ', "
                    . $user_table . ".first_name, ' ', "
                    . $user_table . ".last_name) AS specialist_name"
                ),
                $appointment_type_table . '.name AS appointment_type_name',
            )
            ->leftJoin(
                $appointment_type_table,
                'appointment_type_id',
                $appointment_type_table.'.id'
            )
            ->leftJoin(
                $specialist_table,
                $specialist_table . '.id',
                $appointment_table . '.specialist_id'
            )
            ->leftJoin(
                $employee_table,
                'employee_id',
                $employee_table . '.id'
            )
            ->leftJoin($user_table, 'user_id', '=', $user_table . '.id')
            ->leftJoin(
                $specialist_title_table,
                'specialist_title_id',
                $specialist_title_table . '.id'
            )
            ->where($appointment_table . '.patient_id', $patient_id);
    }

                /**
     * Get the patients for organization.
     */
    public function organizations()
    {
        return $this->belongsToMany(Organization::class,'organization_patient');
    }
}
