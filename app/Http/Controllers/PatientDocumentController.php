<?php

namespace App\Http\Controllers;

use App\Enum\FileType;
use App\Models\Patient;
use Illuminate\Http\Response;
use App\Models\PatientDocument;
use App\Http\Requests\PatientDocumentRequest;

class PatientDocumentController extends Controller
{
    /**
     * [Patient Document] - Store
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientDocumentRequest $request, Patient $patient)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', PatientDocument::class);

        $patient_document = PatientDocument::create([
            ...$request->validated(),
            'patient_id'     => $patient->id,
            'created_by'     => auth()->user()->id,
            'is_updatable'   => false,
            'origin'         => 'UPLOADED'
        ]);

        if ($file = $request->file('file')) {
            $file_name = generateFileName(FileType::PATIENT_DOCUMENT, $patient_document->id, $file->extension(), time());
            $file_path = '/' . $file->storeAs(getUserOrganizationFilePath(), $file_name);

            $patient_document->file_type =  $file->extension();
            $patient_document->file_path = url($file_path);
            $patient_document->save();
        }

        return response()->json(
            [
                'message' => 'Patient Document Created',
                'data'    => $patient_document
            ],
            Response::HTTP_CREATED
        );
    }
}
