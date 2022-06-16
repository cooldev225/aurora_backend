<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
        'max_clinics',
        'max_employees',
        'prova_device_id',
        'owner',
    ];
}