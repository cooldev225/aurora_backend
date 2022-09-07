<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientDocumentRequest;
use App\Models\Patient;
use App\Models\PatientDocument;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PatientDocumentController extends Controller
{
    /**
     * [Patient Document] - List
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAll', PatientDocument::class);

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
    public function store(Request $request, Patient $patient)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', PatientDocument::class);

        $patientDocument = PatientDocument::create([
            'patient_id'     => $patient->id,
            'appointment_id' => $request->appointment_id,
            'specialist_id'  => $request->specialist_id,
            'document_name'  => $request->document_name,
            'document_type'  => $request->document_type,
            'created_by'     => auth()->user()->id,
        ]);

        //UPLOAD FILE

        return response()->json(
            [
                'message' => 'Patient Document Created',
                'data'    => $patientDocument
            ],
            Response::HTTP_CREATED
        );
    }
}
