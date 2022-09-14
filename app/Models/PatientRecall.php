<?php

namespace App\Models;

use App\Mail\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PatientRecall extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'organization_id',
        'patient_id',
        'time_frame',
        'date_recall_due',
        'confirmed',
        'reason',
    ];

    /**
     * Return Patient
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    /**
     * Return Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

}
