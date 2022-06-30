<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'color',
        'mbs_item_number',
        'mbs_description',
        'clinical_code',
        'name',
        'invoice_by',
        'arrival_time',
        'appointment_time',
        'payment_tier_1',
        'payment_tier_2',
        'payment_tier_3',
        'payment_tier_4',
        'payment_tier_5',
        'payment_tier_6',
        'payment_tier_7',
        'payment_tier_8',
        'payment_tier_9',
        'payment_tier_10',
        'payment_tier_11',
        'anesthetist_required',
        'status',
    ];
}
