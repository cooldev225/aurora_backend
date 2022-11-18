<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorAddressBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id','provider_no', 'title', 'first_name', 'last_name',
        'practice_address', 'practice_phone', 'practice_fax', 'practice_email', 'practice_name', 'healthlink_edi', 'preferred_communication_method'
    ];

    protected $appends = [
        'full_name'
    ];

    public function getFullNameAttribute()
    {
        return $this->title . ' ' . $this->first_name . ' ' . $this->last_name;
    }
}
