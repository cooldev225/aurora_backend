<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientBilling extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'member_number',
        'member_reference_number',
        'health_fund_id',
        'has_medicare_concession',
        'billing_type',
        'verified_at',
        'is_valid',
    ];

    /**
     * Return Patient
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
