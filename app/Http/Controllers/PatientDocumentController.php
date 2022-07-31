<?php

namespace App\Http\Controllers;

use App\Models\PatientDocument;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PatientDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $patient_id = $request->patient_id;

        $patientDocumentList = PatientDocument::where('patient_id', $patient_id)
            ->with('letter')
            ->with('report')
            ->with('specialist_audio')
            ->with('clinical_note')
            ->orderByDesc('updated_at')
            ->get();

        return response()->json(
            [
                'message'   => 'Patient Document List',
                'data'      => $patientDocumentList,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $data = $request->all();
        $data['created_by'] = $user_id;
        $patientDocument = PatientDocument::createDocument($data);

        return response()->json(
            [
                'message' => 'Patient Document Created',
                'data' => $patientDocument,
            ],
            Response::HTTP_CREATED
        );
    }
}
