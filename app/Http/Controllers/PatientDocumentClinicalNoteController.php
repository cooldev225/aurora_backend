<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientDocumentClinicalNoteStoreRequest;
use App\Http\Requests\PatientDocumentClinicalNoteUpdateRequest;
use App\Http\Requests\PatientDocumentClinicalNoteUploadRequest;
use App\Models\Patient;
use App\Models\PatientDocument;
use App\Models\PatientClinicalNote;
use Illuminate\Http\Response;

class PatientDocumentClinicalNoteController extends Controller
{
    public function store(PatientDocumentClinicalNoteStoreRequest $request)
    {
        $user_id = auth()->user()->id;
        $data = [
            ...$request->all(),
            'document_type' => 'CLINICAL_NOTE',
            'created_by'    => $user_id,
        ];
        $patient_document = PatientDocument::create($data);

        $patient_clinical_note = PatientClinicalNote::create([
            ...$request->all(),
            'patient_document_id' => $patient_document->id,
        ]);
        $patient_clinical_note->generatePDFFile();

        return response()->json(
            [
                'message' => 'New Patient Clinical Note Created',
            ],
            Response::HTTP_CREATED
        );
    }

    public function update(
        PatientDocumentClinicalNoteUpdateRequest $request,
        PatientClinicalNote $patient_documents_clinical_note
    )
    {
        $patient_documents_clinical_note->update([
            ...$request->all(),
        ]);
        $patient_documents_clinical_note->generatePDFFile();

        return response()->json(
            [
                'message' => 'Patient Clinical Note Updated',
            ],
            Response::HTTP_CREATED
        );
    }
    
    /**
     * Upload the patient document
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(
        Patient $patient,
        PatientDocumentClinicalNoteUploadRequest $request
    ) {
        $user_id = auth()->user()->id;
        $data = [
            ...$request->all(),
            'patient_id'    => $patient->id,
            'document_type' => 'CLINICAL_NOTE',
            'created_by'    => $user_id,
        ];
        $patient_document = PatientDocument::create($data);

        $file_path = '';
        if ($file = $request->file('file')) {
            $file_name = 'patient_clinical_note_' . $patient_document->id
                . '_' . time() . '.' . $file->extension();
            $file_path = '/' . $file->storeAs('files/patient_documents', $file_name);
            $patient_document->file_path = $file_path;
            $patient_document->save();
        }

        return response()->json(
            [
                'message' => 'Patient Clinical Note Uploaded',
            ],
            Response::HTTP_CREATED
        );
    }

    public function destroy(PatientClinicalNote $patient_clinical_note)
    {
        $patient_clinical_note->patient_document->delete();
        $patient_clinical_note->delete();

        return response()->json(
            [
                'message' => 'Patient Clinical Note Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
