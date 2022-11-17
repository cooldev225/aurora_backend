<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentIndexRequest;
use App\Http\Requests\PatientDocumentActionLogRequest;
use App\Http\Requests\PatientDocumentActionLogIndexRequest;

use App\Models\Appointment;
use App\Models\PatientDocumentsActionLog;
use App\Models\PatientDocument;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PatientDocumentActionLogsController extends Controller
{

    /**
     * Retrieves all documents without giver filters
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PatientDocumentActionLogIndexRequest $request)
    {
        $params = $request->validated();
        $log = PatientDocumentsActionLog::where('patient_document_id', '=', $params['patient_document_id']);
        foreach ($params as $column => $param) {
            $log = $log->where($column, '=', $param);
        }

        return response()->json(
            [
                'message' => 'New Patient Document Action Log Created',
                'data'    => $log->get(),
            ],
            Response::HTTP_CREATED
        );
    }

    public function store(PatientDocumentActionLogRequest $request)
    {

        $params = $request->validated();
        // Verify the user can access this function via policy
        // $this->authorize('create', PatientDocumentsActionLog::class);

        $data = PatientDocumentsActionLog::create([
            ...$params,
            'user_id' => auth()->user()->id,
        ]);

        return response()->json(
            [
                'message' => 'New Patient Document Action Log Created',
                'data'    => $data,
            ],
            Response::HTTP_CREATED
        );
    }
}
