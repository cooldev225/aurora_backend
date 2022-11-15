<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmFilledWeek extends Model
{
    use HasFactory;
    protected $fillable = ['start_date','end_date'];

    public function hrmWeeklySchedule () {
       return $this->hasMany(HrmWeeklySchedule::class);
    }
}
