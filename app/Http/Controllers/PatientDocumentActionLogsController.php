<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentIndexRequest;
use App\Http\Requests\PatientDocumentActionLogRequest;
use App\Http\Requests\PatientDocumentActionLogIndexRequest;

use App\Models\Appointment;
use App\Models\PatientDocumentsActionLog;
use App\Models\OutgoingMessageLog;
use App\Models\PatientDocument;
use App\Models\SpecialistClinicRelation;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

use App\Enum\OutMessageSendMethod;
use App\Enum\DocumentActionStatusType;
use App\Enum\OutMessageSendStatus;

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


        $patient_document = PatientDocument::find($params['patient_document_id']);
        $patient = $patient_document->patient;

        $specialist = $patient_document->specialist;
        $appointment = $patient_document->appointment;
        $sending_provider_number = SpecialistClinicRelation::
            where('specialist_id', $specialist->id)
            ->where('clinic_id', $appointment->clinic_id)
            ->first();

        $data = PatientDocumentsActionLog::create([
            ...$params,
            'user_id' => auth()->user()->id,
        ]);

        OutgoingMessageLog::create([
            'send_method'                   => OutMessageSendMethod::PRINT,
            'send_status'                   => OutMessageSendStatus::SENT,
            'sending_doctor_name'           => $specialist->full_name,
            'sending_doctor_provider'       => $sending_provider_number->provider_number,
            'receiving_doctor_name'         => '',
            'receiving_doctor_provider'     => '',
            'organization_id'               => $patient_document->organization_id,
            'patient_id'                    => $patient->id,
            'sending_doctor_user'           => $specialist->id,
            'sending_user'                  => auth()->user()->id,
            'message_contents'              => '',
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
