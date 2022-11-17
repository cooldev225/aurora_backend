<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDocumentsActionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_document_id', 'status', 'user_id'
    ];
}
