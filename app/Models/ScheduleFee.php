<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id', 'allow_zero', 'item_number', 'medicare_fee',
        'medicare_fee_75', 'medicare_fee_85', 'procedure_or_consultation',
        'dva_in', 'dva_out', 'tac', 'work_cover', 'status'
    ];
}
