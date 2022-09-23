<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmWeeklyScheduleTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['clinic_id','role_id','user_id'];

    /**
     * Returns user
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

        /**
     * Returns timeslots
     */
    public function timeslots()
    {
        return $this->hasMany(HrmScheduleTimeslots::class);
    }

}
