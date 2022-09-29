<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentIndexRequest;
use App\Http\Requests\DocumentPatientAssignRequest;
use App\Models\Patient;
use App\Models\PatientDocument;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{

    /**
     * Retrieves all documents without giver filters
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DocumentIndexRequest $request)
    {

        $params = $request->validated();
        $documents = PatientDocument::where('organization_id', auth()->user()->organization_id);

        foreach ($params as $column => $param) {

            if ($column == 'is_missing_information' && $param == 1) {
                Log::info('is_missing_patient' . $param);
                $documents = $documents->whereNull('patient_id')->orWhereNull('specialist_id');
            } else if (!empty($param)) {
                if ($param == 'before_date') {
                    $documents = $documents->where('created_at', '<=', $param);
                } else if ($param == 'after_date') {
                    $documents = $documents->where('created_at', '>=', $param);
                } else {
                    $documents = $documents->where($column, $param);
                }
            }
        }

        return response()->json(
            [
                'message' => 'Document List',
                'data'    => $documents->get(),
            ],
            Response::HTTP_OK
        );
    }

    public function patient(DocumentPatientAssignRequest $request)
    {
        $params = $request->validated();
        $patient = Patient::find($params['patient_id']);
        $document = PatientDocument::find($params['document_id']);
        if($patient && $document)
        {
            $document->patient_id = $patient->id;
            $document->save();
            return response()->json(
                [
                    'message' => 'Document Updated',
                    'data'    => $patient->id,
                ],
                Response::HTTP_OK
            );
        }
        else
        {
            return response()->json(
                [
                    'message' => 'Data is not existed!',
                ],
                Response::HTTP_NO_CONTENT
            );
        }
    }
}
