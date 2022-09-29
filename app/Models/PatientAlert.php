<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAlert extends Model
{
    protected $fillable = [
    'created_by', 'alert_level','explanation'
    ];

    protected $appends = [
        'created_by_name'
    ];

    use HasFactory;

    
    public function getCreatedByNameAttribute()
    {
        return User::find('created_by')->full_name;  
    }
}