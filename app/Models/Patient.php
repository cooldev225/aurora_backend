<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'UR_number',
        'title',
        'first_name',
        'last_name',
        'email',
        'home_number',
        'work_number',
        'mobile_number',
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
    ];

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
     * Return patient list for organization
     */
    public static function organizationPatients($organization_id = null)
    {
        if ($organization_id == null) {
            $organization_id = auth()->user()->organization_id;
        }

        $organization_table = (new Organization())->getTable();
        $patient_table = (new Patient())->getTable();
        $patient_billing_table = (new PatientBilling())->getTable();

        return PatientOrganization::select('*', $patient_table . '.id')
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
            ->leftJoin(
                $patient_billing_table,
                "{$patient_billing_table}.patient_id",
                '=',
                "{$patient_table}.id"
            )
            ->where('organization_id', $organization_id);
    }
}
