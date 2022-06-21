<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
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
        'marital_status',
        'birth_place_code',
        'country_of_birth',
        'birth_state',
        'allergies',
        'height',
        'weight',
        'bmi',
    ];
}
