<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'gender',
        'date_of_birth',
        'address',
        'street',
        'city',
        'state',
        'postcode',
        'country',
        'marital_status',
        'birth_place_code',
        'country_of_birth',
        'birth_state',
        'allergies',
        'height',
        'weight',
        'bmi',
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
}
