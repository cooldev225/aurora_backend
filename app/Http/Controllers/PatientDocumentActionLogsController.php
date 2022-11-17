<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentIndexRequest;
use App\Http\Requests\DocumentPatientAssignRequest;
use App\Http\Requests\PatientDocumentActionLogRequest;
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
    public function index()
    {
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

        // Create PAtient Report Model for future editing
        return response()->json(
            [
                'message' => 'New Patient Document Action Log Created',
                'data'    => $data,
            ],
            Response::HTTP_CREATED
        );
    }
}
