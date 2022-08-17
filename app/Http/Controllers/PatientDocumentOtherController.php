<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientDocumentOtherUploadRequest;
use App\Models\Patient;
use App\Models\PatientDocument;
use Illuminate\Http\Response;

class PatientDocumentOtherController extends Controller
{
    /**
     * Upload the patient document
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(
        Patient $patient,
        PatientDocumentOtherUploadRequest $request
    ) {
        $user_id = auth()->user()->id;
        $data = [
            ...$request->all(),
            'patient_id'    => $patient->id,
            'document_type' => 'OTHER',
            'created_by'    => $user_id,
        ];
        $patient_document = PatientDocument::create($data);

        $file_path = '';
        if ($file = $request->file('file')) {
            $file_name = 'patient_letter_' . $patient_document->id
                . '_' . time() . '.' . $file->extension();
            $file_path = '/' . $file->storeAs('files/patient_documents', $file_name);
            $patient_document->file_path = url($file_path);
            $patient_document->save();
        }

        return response()->json(
            [
                'message' => 'Patient Other Document Uploaded',
            ],
            Response::HTTP_CREATED
        );
    }
}
