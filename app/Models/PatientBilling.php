<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientBilling extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'medicare_number',
        'medicare_reference_number',
        'medicare_expiry_date',
        'concession_number',
        'concession_expiry_date',
        'pension_number',
        'pension_expiry_date',
        'healthcare_card_number',
        'healthcare_card_expiry_date',
        'health_fund_id',
        'health_fund_membership_number',
        'health_fund_reference_number',
        'health_fund_expiry_date',
        'account_holder_type',
        'account_holder_id',
        'fund_excess',
    ];

    /**
     * Return Patient
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
