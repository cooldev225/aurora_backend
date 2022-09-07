<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientSpecialistAudio extends Model
{
    use HasFactory;

    protected $table = 'patient_specialist_audios';

    protected $fillable = [
        'patient_document_id', 'patient_id', 'specialist_id',
        'file_path', 'translated_by'
    ];

    /**
     * Return Patient Document
     */
    public function patient_document()
    {
        return $this->belongsTo(PatientDocument::class);
    }

    /**
     * Return Patient
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Return Specialist
     */
    public function specialist()
    {
        return $this->belongsTo(User::class, 'specialist_id');
    }

    /**
     * Return Patient
     */
    public function translated_by()
    {
        return $this->belongsTo(User::class, 'translated_by');
    }
}
