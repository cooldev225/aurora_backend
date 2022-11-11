<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmDeletedSchedule extends Model
{
    use HasFactory;
    protected $fillable = ['clinic_id','week_day','category','restriction','user_id','start_time','end_time','reason', 'organization_id', 'date', 'hrm_weekly_schedule_id', 'status'];

}
