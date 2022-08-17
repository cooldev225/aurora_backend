<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientDocumentLetterStoreRequest;
use App\Http\Requests\PatientDocumentLetterUpdateRequest;
use App\Http\Requests\PatientDocumentLetterUploadRequest;
use App\Models\Patient;
use App\Models\PatientDocument;
use App\Models\PatientLetter;
use Illuminate\Http\Response;

class PatientDocumentLetterController extends Controller
{
    public function store(PatientDocumentLetterStoreRequest $request)
    {
        $user_id = auth()->user()->id;
        $data = [
            ...$request->all(),
            'document_type' => 'LETTER',
            'created_by'    => $user_id,
        ];
        $patient_document = PatientDocument::create($data);

        $patient_letter = PatientLetter::create([
            ...$request->all(),
            'patient_document_id' => $patient_document->id,
        ]);
        $patient_letter->generatePDFFile();

        return response()->json(
            [
                'message' => 'New Patient Letter Created',
            ],
            Response::HTTP_CREATED
        );
    }

    public function update(
        PatientDocumentLetterUpdateRequest $request,
        PatientLetter $patient_documents_letter
    )
    {
        $patient_documents_letter->update([
            ...$request->all(),
        ]);
        $patient_documents_letter->generatePDFFile();

        return response()->json(
            [
                'message' => 'Patient Letter Updated',
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
        PatientDocumentLetterUploadRequest $request
    ) {
        $user_id = auth()->user()->id;
        $data = [
            ...$request->all(),
            'patient_id'    => $patient->id,
            'document_type' => 'LETTER',
            'created_by'    => $user_id,
        ];
        $patient_document = PatientDocument::create($data);

        $file_path = '';
        if ($file = $request->file('file')) {
            $file_name = 'patient_letter_' . $patient_document->id
                . '_' . time() . '.' . $file->extension();
            $file_path = '/' . $file->storeAs('files/patient_documents', $file_name);
            $patient_document->file_path = $file_path;
            $patient_document->save();
        }

        return response()->json(
            [
                'message' => 'Patient Letter Uploaded',
            ],
            Response::HTTP_CREATED
        );
    }

    public function destroy(PatientLetter $patient_letter)
    {
        $patient_letter->patient_document->delete();
        $patient_letter->delete();

        return response()->json(
            [
                'message' => 'Patient Letter Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
