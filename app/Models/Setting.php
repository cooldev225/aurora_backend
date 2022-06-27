<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'apt_start_time_slot',
        'apt_end_time_slot',
        'total_time_diff',
        'instructions',
        'notes',
        'type',
    ];
}
