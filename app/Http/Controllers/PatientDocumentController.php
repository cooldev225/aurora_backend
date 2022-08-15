<?php

namespace App\Http\Controllers;

use App\Models\Patient;
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
            ->get()->toArray();

        foreach ($patientDocumentList as $key => $patient_document) {
            $patient_document['file_type'] = 'jpg';
            $patientDocumentList[$key] = $patient_document;
        }

        return response()->json(
            [
                'message' => 'Patient Document List',
                'data'    => $patientDocumentList,
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
                'data'    => $patientDocument,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Upload the patient document
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(PatientDocumentController $request, Patient $patient) {

        $patientDocument = PatientDocument::create([
            'patient_id'     => $patient->id,
            'appointment_id' => $request->appointment_id,
            'specialist_id'  => $request->specialist_id,
            'document_name'  => $patient->document_name,
            'document_type'  => $patient->document_type,
            'created_by'     => auth()->user()->id,
        ]);

        if ($file = $request->file('document')) {
            $arrImageExtensions = [
                'png', 'jpe', 'jpeg', 'jpg', 'gif',
                'bmp', 'ico', 'tiff', 'tif', 'svg'
            ];

            $file_extension = strtolower($file->extension());
            $file_type = 'OTHER';
            if (in_array($file_extension, $arrImageExtensions)) {
                $file_type = 'IMAGE';
            } else if ($file_extension == 'PDF') {
                $file_type = 'PDF';
            }

            $file_name = 'document_' . $patientDocument->id . '_' . time() . '.' . $file_extension;
            $document_path = '/' . $file->storeAs('files/patient_documents', $file_name);

            $patientDocument->file_path = $document_path;
            $patientDocument->file_type = $file_type;
        }

        $patientDocument->save();

        return response()->json(
            [
                'message' => 'Patient Document Uploaded',
                'data'    => $patientDocument,
            ],
            Response::HTTP_CREATED
        );
    }
}
