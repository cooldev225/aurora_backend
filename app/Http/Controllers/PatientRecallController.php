<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRecallRequest;
use App\Models\Patient;
use Illuminate\Http\Response;
use App\Models\PatientRecall;

class PatientRecallController extends BaseOrganizationController
{
    /**
     * [Patient Recall] - List all recalls for this patient
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        return response()->json(
            [
                'message' => 'Patient Recall list',
                'data' => $patient->recalls,
            ],
            Response::HTTP_CREATED
        );
    }
    
    /**
     * [Patient Recall] - Store
     *
     * @param  \App\Http\Requests\PatientRecallRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRecallRequest $request)
    {

        $patientRecall = PatientRecall::create([
            'user_id'           => auth()->user()->id,
            'patient_id'        => $request->patient_id,
            'organization_id'   => $request->user()->organization_id,
            'date_recall_due'   => date('Y-m-d', strtotime("+" . $request->time_frame . " months",strtotime(date('Y-m-d')))),
            'time_frame'        => $request->time_frame,
            'confirmed'         => false,
            'reason'            => $request->reason,
        ]);

        return response()->json(
            [
                'message' => 'New Patient Recall created',
                'data' => $patientRecall,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Patient Recall] - Update
     *
     * @param  \App\Http\Requests\PatientRecallRequest  $request
     * @param  \App\Models\PatientRecall  $patientRecall
     * @return \Illuminate\Http\Response
     */
    public function update(
        PatientRecallRequest $request,
        PatientRecall $patientRecall
    ) {
        $patientRecall->update([
            'user_id'           => auth()->user()->id,
            'patient_id'        => $request->patient_id,
            'organization_id'   => $request->user()->organization_id,
            'date_recall_due'   => date('Y-m-d', strtotime("+" . $request->time_frame . " months",strtotime(date('Y-m-d')))),
            'time_frame'        => $request->time_frame,
            'confirmed'         => false,
            'reason'            => $request->reason,
        ]);

        return response()->json(
            [
                'message' => 'New Patient Recall Updated',
                'data' => $patientRecall,
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * [Patient Recall] - Destroy
     *
     * @param  \App\Models\PatientRecall  $patientRecall
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientRecall $patientRecall)
    {
        $patientRecall->delete();

        return response()->json(
            [
                'message' => 'Patient Recall Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
