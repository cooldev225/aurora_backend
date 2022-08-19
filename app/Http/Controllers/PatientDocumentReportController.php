<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientDocumentReportStoreRequest;
use App\Http\Requests\PatientDocumentReportUpdateRequest;
use App\Http\Requests\PatientDocumentReportUploadRequest;
use App\Models\Patient;
use App\Models\PatientDocument;
use App\Models\PatientReport;
use Illuminate\Http\Response;

class PatientDocumentReportController extends Controller
{
    /**
     * [Patient Document Report] - Store
     *
     * @param  \App\Http\Requests\PatientDocumentLetterStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * [Patient Document Report] - Update
     *
     * @param  \App\Http\Requests\PatientDocumentLetterUpdateRequest  $request
     * @param  \App\Models\PatientLetter  $patient_documents_letter
     * @return \Illuminate\Http\Response
     */
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
     * [Patient Document Report] - Upload
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(
        Patient $patient,
        PatientDocumentReportUploadRequest $request
    ) {
        $user_id = auth()->user()->id;
        $data = [
            ...$request->all(),
            'patient_id'    => $patient->id,
            'document_type' => 'REPORT',
            'created_by'    => $user_id,
        ];
        $patient_document = PatientDocument::create($data);

        $file_path = '';
        if ($file = $request->file('file')) {
            $file_name = 'patient_report_' . $patient_document->id
                . '_' . time() . '.' . $file->extension();
            $file_path = '/' . $file->storeAs('files/patient_documents', $file_name);
            $patient_document->file_path = url($file_path);
            $patient_document->save();
        }

        return response()->json(
            [
                'message' => 'Patient Report Uploaded',
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Patient Document Report] - Destroy
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @return \Illuminate\Http\Response
     */
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
