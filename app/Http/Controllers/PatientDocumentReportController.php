<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientDocumentReportStoreRequest;
use App\Http\Requests\PatientDocumentReportUpdateRequest;
use App\Http\Requests\PatientDocumentReportUploadRequest;
use App\Models\PatientDocument;
use App\Models\PatientReport;
use Illuminate\Http\Response;

class PatientDocumentReportController extends Controller
{
    public function store(PatientDocumentReportStoreRequest $request)
    {
        $user_id = auth()->user()->id;
        $data = [
            ...$request->all(),
            'document_type' => 'REPORT',
            'created_by'    => $user_id,
        ];
        $patient_document = PatientDocument::create($data);

        $patient_report = PatientReport::create([
            ...$request->all(),
            'patient_document_id' => $patient_document->id,
        ]);
        $patient_report->generatePDFFile();

        return response()->json(
            [
                'message' => 'New Patient Report Created',
            ],
            Response::HTTP_CREATED
        );
    }

    public function update(
        PatientDocumentReportUpdateRequest $request,
        PatientReport $patient_documents_report
    )
    {
        $patient_documents_report->update([
            ...$request->all(),
        ]);
        $patient_documents_report->generatePDFFile();

        return response()->json(
            [
                'message' => 'Patient Report Updated',
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
    public function upload(PatientDocumentReportUploadRequest $request) {
        $user_id = auth()->user()->id;
        $data = [
            ...$request->all(),
            'document_type' => 'REPORT',
            'created_by'    => $user_id,
        ];
        $patient_document = PatientDocument::create($data);

        $file_path = '';
        if ($file = $request->file('file')) {
            $file_name = 'patient_report_' . $patient_document->id
                . '_' . time() . '.' . $file->extension();
            $file_path = '/' . $file->storeAs('files/patient_documents', $file_name);
            $patient_document->file_path = $file_path;
            $patient_document->save();
        }

        return response()->json(
            [
                'message' => 'Patient Report Uploaded',
            ],
            Response::HTTP_CREATED
        );
    }

    public function destroy(PatientReport $patient_report)
    {
        $patient_report->patient_document->delete();
        $patient_report->delete();

        return response()->json(
            [
                'message' => 'Patient Report Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
