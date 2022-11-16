<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEmployeeLeave extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'organization_id', 'description', 'status', 'leave_type','start_date', 'end_date', 'full_day', 'start_time', 'end_time' ];
}
