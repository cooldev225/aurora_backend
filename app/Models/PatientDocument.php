<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientDocument extends Model
{
    protected $fillable = [
        'patient_id', 'appointment_id', 'specialist_id',
        'document_type', 'created_by', 'file_path', 'is_updatable',
        'origin'
    ];

    /**
     * Return Patient
     */
    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Return Specialist
     */
    public function specialist() {
        return $this->belongsTo(Specialist::class);
    }

    /**
     * Return Appointment
     */
    public function appointment() {
        return $this->belongsTo(Appointment::class);
    }

    public function letter() {
        return $this->hasOne(PatientLetter::class);
    }

    public function report() {
        return $this->hasOne(PatientReport::class);
    }

    public function specialist_audio() {
        return $this->hasOne(PatientSpecialistAudio::class);
    }

    public function clinical_note() {
        return $this->hasOne(PatientClinicalNote::class);
    }

    public static function getDocument($patient_document_id) {
        return PatientDocument::where('id', $patient_document_id)
            ->with('letter')
            ->with('report')
            ->with('specialist_audio')
            ->with('clinical_note')
            ->orderByDesc('updated_at')
            ->first();
    }

    public static function createDocument($data)
    {
        $patient_document = PatientDocument::create($data);
        $data['patient_document_id'] = $patient_document->id;

        if ($patient_document->document_type == 'LETTER') {

            PatientLetter::create($data);

        } else if ($patient_document->document_type == 'REPORT') {

            PatientReport::create($data);

        } else if ($patient_document->document_type == 'CLINICAL_NOTE') {

            PatientClinicalNote::create($data);

        } else if ($patient_document->document_type == 'PATHOLOGY_REPORT') {


        } else if ($patient_document->document_type == 'AUDIO') {

            PatientSpecialistAudio::create($data);

        } else if ($patient_document->document_type == 'USB_CAPTURE') {

        } else if ($patient_document->document_type == 'OTHER') {

        }

        return PatientDocument::getDocument($patient_document->id);
    }

    public function updateDocument($data)
    {        
        $this->update($data);

        if ($this->document_type == 'LETTER') {

            $this->letter->update($data);

        } else if ($this->document_type == 'REPORT') {

            $this->report->update($data);

        } else if ($this->document_type == 'CLINICAL_NOTE') {

            $this->clinical_note->update($data);

        } else if ($this->document_type == 'PATHOLOGY_REPORT') {


        } else if ($this->document_type == 'AUDIO') {

            $this->specialist_audio()->update($data);

        } else if ($this->document_type == 'USB_CAPTURE') {

        } else if ($this->document_type == 'OTHER') {

        }
    }

    public function delete()
    {        
        if ($this->document_type == 'LETTER') {

            $this->letter->delete();

        } else if ($this->document_type == 'REPORT') {

            $this->report->delete();

        } else if ($this->document_type == 'CLINICAL_NOTE') {

            $this->clinical_note->delete();

        } else if ($this->document_type == 'PATHOLOGY_REPORT') {


        } else if ($this->document_type == 'AUDIO') {

            $this->specialist_audio->delete();

        } else if ($this->document_type == 'USB_CAPTURE') {

        } else if ($this->document_type == 'OTHER') {

        }

        $this->delete();
    }
}
