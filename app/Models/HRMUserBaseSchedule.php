<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRMUserBaseSchedule extends Model
{
    use HasFactory;

    protected $appends = ['clinic_name'];

    /**
     * Return the clinic name of the clinic
     */
    public function getClinicNameAttribute()
    {
        return $this->clinic->name;  
    }

    /**
     * Return user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return clinic
     */
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

}
