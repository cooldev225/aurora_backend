<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialistClinicRelation extends Model
{
    use HasFactory;

    protected $fillable = ['specialist_id', 'clinic_id'];
}
