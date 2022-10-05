<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentCodes extends Model
{
    use HasFactory;

    protected $fillable = ['diagnosis_codes','indication_codes','extra_items_used','is_complete','appointment_id','procedures_undertaken'];
}
