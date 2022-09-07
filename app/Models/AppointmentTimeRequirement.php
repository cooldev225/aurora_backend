<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentTimeRequirement extends Model
{
    use HasFactory;

    protected $fillable = ['organization_id', 'title', 'type', 'base_time'];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
