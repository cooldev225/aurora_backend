<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreAdmissionConsent extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id', 'text'
    ];

    /**
     * Return Section
     */
    public function organization() {
        return $this->belongsTo(Organization::class);
    }
}
