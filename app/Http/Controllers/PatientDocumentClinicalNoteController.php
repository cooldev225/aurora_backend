<?php

namespace App\Http\Controllers;

use App\Enum\FileType;
use App\Models\Patient;
use Illuminate\Http\Response;
use App\Models\PatientDocument;
use App\Models\PatientClinicalNote;
use App\Http\Requests\PatientDocumentClinicalNoteStoreRequest;
use App\Http\Requests\PatientDocumentClinicalNoteUpdateRequest;
use App\Http\Requests\PatientDocumentClinicalNoteUploadRequest;

class PatientDocumentClinicalNoteController extends Controller
{
    /**
     * [Patient Document Clinical Note] - Store
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PatientDocumentClinicalNoteStoreRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', PatientDocument::class);
        $this->authorize('create', PatientClinicalNote::class);

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

    /**
     * [Patient Document Clinical Note] - Update
     *
      * @return \Illuminate\Http\Response
     */
    public function update(
        PatientDocumentClinicalNoteUpdateRequest $request,
        PatientClinicalNote $patient_documents_clinical_note
    )
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $patient_documents_clinical_note);

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
     * [Patient Document Clinical Note] - Upload
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(
        Patient $patient,
        PatientDocumentClinicalNoteUploadRequest $request
    ) {
        // Verify the user can access this function via policy
        $this->authorize('create', PatientDocument::class);
        $this->authorize('create', PatientClinicalNote::class);

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
            $file_name = generateFileName(FileType::PATIENT_DOCUMENT, $patient_document->id, $file->extension(), time());
            $file_path = '/' . $file->storeAs(getUserOrganizationFilePath(), $file_name);

            $patient_document->file_path = url($file_path);
            $patient_document->save();
        }

        return response()->json(
            [
                'message' => 'Patient Clinical Note Uploaded',
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Patient Document Clinical Note] - Destroy
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientClinicalNote $patient_clinical_note)
    {
        $patient_document = $patient_clinical_note->patient_document;

        // Verify the user can access this function via policy
        $this->authorize('delete', $patient_document);
        $this->authorize('delete', $patient_clinical_note);

        $patient_document->delete();
        $patient_clinical_note->delete();

        return response()->json(
            [
                'message' => 'Patient Clinical Note Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
