<?php

namespace App\Http\Controllers;

use App\Enum\FileType;
use App\Models\Patient;
use Illuminate\Http\Response;
use App\Models\PatientDocument;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PatientDocumentOtherUploadRequest;

class PatientDocumentOtherController extends Controller
{
    /**
     * [Patient Document Other] - Upload
     *
     * @param  \App\Http\Requests\PatientDocumentLetterStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(
        Patient $patient,
        PatientDocumentOtherUploadRequest $request
    ) {
        // Verify the user can access this function via policy
        $this->authorize('create', PatientDocument::class);

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
            Storage::put($file_path, file_get_contents($file));

            $patient_document->file_path = $file_name;
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
