<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientDocumentClinicalNoteRequest;
use App\Models\PatientClinicalNote;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PatientDocumentClinicalNoteController extends Controller
{

    public function store(PatientDocumentClinicalNoteRequest $request)
    {
    
        return response()->json(
            [
                'message' => 'New Patient clinical note created',
            ],
            Response::HTTP_CREATED
        );
    }

    public function destroy(PatientClinicalNote $patientClinicalNote)
    {
        $patientClinicalNote->delete();

        return response()->json(
            [
                'message' => 'Patient Clinical Note Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
