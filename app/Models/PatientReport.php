<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_document_id', 'patient_id', 'body'
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

    public function generatePDFFile() {
        ////////////////////////////////////////////////////////////////////////
        // Generate PDF
        $file_path = '';

        $patient_document = $this->patient_document;
        $patient_document->file_type = 'PDF';
        $patient_document->file_path = $file_path;
        $patient_document->save();
    }
}
