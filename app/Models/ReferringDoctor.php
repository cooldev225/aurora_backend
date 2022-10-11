<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferringDoctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_no', 'title', 'first_name', 'last_name',
        'address', 'street', 'city', 'state', 'country', 'postcode',
        'phone', 'fax', 'mobile', 'email', 'practice_name', 'healthlink_edi'
    ];

    protected $appends = [
        'full_name'
    ];

    public function getFullNameAttribute()
    {
        return $this->title . ' ' . $this->first_name . ' ' . $this->last_name;
    }
}
