<?php

namespace App\Http\Controllers;

use App\Enum\FileType;
use App\Models\Patient;
use App\Models\PatientLetter;
use Illuminate\Http\Response;
use App\Models\PatientDocument;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PatientDocumentLetterStoreRequest;
use App\Http\Requests\PatientDocumentLetterUpdateRequest;
use App\Http\Requests\PatientDocumentLetterUploadRequest;

class PatientDocumentLetterController extends Controller
{
    /**
     * [Patient Document Letter] - Store
     *
     * @param  \App\Http\Requests\PatientDocumentLetterStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientDocumentLetterStoreRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', PatientDocument::class);
        $this->authorize('create', PatientLetter::class);

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

    /**
     * [Patient Document Letter] - Update
     *
     * @param  \App\Http\Requests\PatientDocumentLetterUpdateRequest  $request
     * @param  \App\Models\PatientLetter  $patient_documents_letter
     * @return \Illuminate\Http\Response
     */
    public function update(
        PatientDocumentLetterUpdateRequest $request,
        PatientLetter $patient_documents_letter
    )
    {
        // Verify the user can access this function via policy
        $this->authorize('update', $patient_documents_letter);

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
     * [Patient Document Letter] - Upload
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(
        Patient $patient,
        PatientDocumentLetterUploadRequest $request
    ) {
        // Verify the user can access this function via policy
        $this->authorize('create', PatientDocument::class);
        $this->authorize('create', PatientLetter::class);

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
            $file_name = generateFileName(FileType::PATIENT_DOCUMENT, $patient_document->id, $file->extension(), time());
            $org_path = getUserOrganizationFilePath();
            
            if (!$org_path) {
                return response()->json(
                    [
                        'message'   => 'Could not find user organization',
                    ],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }
            
            $file_path = "/{$org_path}/{$file_name}";
            $path = Storage::put($file_path, file_get_contents($file));

            $patient_document->file_path = Storage::url($path) . $file_name;
            $patient_document->save();
        }

        return response()->json(
            [
                'message' => 'Patient Letter Uploaded',
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Patient Document Letter] - Destroy
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientLetter $patient_letter)
    {
        $patient_document = $patient_letter->patient_document;

        // Verify the user can access this function via policy
        $this->authorize('create', $patient_document);
        $this->authorize('create', $patient_letter);

        $patient_document->delete();
        $patient_letter->delete();

        return response()->json(
            [
                'message' => 'Patient Letter Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
