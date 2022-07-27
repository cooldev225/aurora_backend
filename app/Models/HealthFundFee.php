<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthFundFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'fee_id', 'fund_id', 'specialist_fee', 'hospital_fee',
        'start_date', 'end_date'
    ];
}