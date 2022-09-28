<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialistClinicRelation extends Model
{
    use HasFactory;

    protected $fillable = ['specialist_id', 'clinic_id', 'provider_number'];

    /**
     * Return User
     */
    public function specialist()
    {
        return $this->belongsTo(User::class, 'specialist_id');
    }

    /**
     * Return Clinic
     */
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
