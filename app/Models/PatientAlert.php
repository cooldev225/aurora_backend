<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAlert extends Model
{
    protected $fillable = [
    'patient_id','created_by', 'alert_level','explanation', 'title','is_dismissed'
    ];

    protected $appends = [
        'created_by_name'
    ];

    use HasFactory;

    
    public function getCreatedByNameAttribute()
    {
        return User::find($this->created_by)->full_name;  
    }
}