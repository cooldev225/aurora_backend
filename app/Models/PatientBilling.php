<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientBilling extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'charge_type',
        'medicare_number',
        'medicare_expiry_date',
        'concession_number',
        'concession_expiry_date',
        'pension_number',
        'pension_expiry_date',
        'healthcare_card_number',
        'healthcare_card_expiry_date',
        'health_fund_id',
        'health_fund_membership_number',
        'health_fund_card_expiry_date',
        'fund_excess',
    ];
}
