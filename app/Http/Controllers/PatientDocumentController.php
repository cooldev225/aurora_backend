<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientDocumentRequest;
use App\Models\Patient;
use App\Models\PatientDocument;
use Illuminate\Http\Response;

class PatientDocumentController extends Controller
{
    /**
     * [Patient Document] - List
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', PatientDocument::class);

        return response()->json(
            [
                'message' => 'Patient Document List',
                'data'    => $patient->documents,
            ],
            Response::HTTP_OK
        );
    }

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
            $file_name = 'patient_document_' . $patient_document->id
                . '_' . time() . '.' . $file->extension();
            $file->storeAs('files/patient_documents', $file_name);
            $patient_document->file_type =  $file->extension();
            $patient_document->file_path = $file_name;
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
