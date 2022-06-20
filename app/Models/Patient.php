<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'clinic_id',
        'title',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'gender',
        'date_of_birth',
        'address',
        'street',
        'city',
        'state',
        'postcode',
        'country',
    ];
}
