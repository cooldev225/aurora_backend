<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientDocumentLetterRequest;
use App\Models\PatientLetter;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class PatientDocumentLetterController extends Controller
{

    public function store(PatientDocumentLetterRequest $request)
    {

        $file_path = 'file path of generated PDF';
        PatientLetter::create([
            'patient_id' => $request->patient_id,
            'to' => $request->to,
            'from' => $request->to,
            'body' => $request->to,
            'file' => $file_path,
        ]);

        return response()->json(
            [
                'message' => 'New Patient Letter created',
            ],
            Response::HTTP_CREATED
        );
    }

    public function update(PatientDocumentLetterRequest $request, PatientLetter $patientLetter)
    {

        $file_path = 'file path of generated PDF';
        $patientLetter->update([
            'patient_id' => $request->patient_id,
            'to' => $request->to,
            'from' => $request->to,
            'body' => $request->to,
            'file' => $file_path,
        ]);

        return response()->json(
            [
                'message' => 'Patient Letter updated',
            ],
            Response::HTTP_CREATED
        );
    }

    public function destroy(PatientLetter $patientLetter)
    {
        $patientLetter->delete();

        return response()->json(
            [
                'message' => 'PatientLetter Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
