<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRecallRequest;
use Illuminate\Http\Response;
use App\Models\PatientRecall;

class PatientRecallController extends BaseOrganizationController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_id = auth()->user()->organization_id;

        $patientRecalls = PatientRecall::where('organization_id', $organization_id)
            ->with('patient')
            ->orderByDesc('date_recall_due')
            ->get();

        return response()->json(
            [
                'message' => 'Patient Recall List',
                'data' => $patientRecalls,
            ],
            Response::HTTP_OK
        );
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PatientRecallRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRecallRequest $request)
    {
        $user_id = auth()->user()->id;
        $time_frame = $request->time_frame;
        $date_recall_due = date('Y-m-d', strtotime("+" . $time_frame . " months",
            strtotime(date('Y-m-d'))));

        $patientRecall = PatientRecall::create([
            'user_id'           => $user_id,
            'patient_id'        => $request->patient_id,
            'organization_id'   => $request->organization_id,
            'date_recall_due'   => $date_recall_due,
            'time_frame'        => $time_frame,
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
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PatientRecallRequest  $request
     * @param  \App\Models\PatientRecall  $patientRecall
     * @return \Illuminate\Http\Response
     */
    public function update(
        PatientRecallRequest $request,
        PatientRecall $patientRecall
    ) {
        $user_id = auth()->user()->id;
        $time_frame = $request->time_frame;
        $date_recall_due = date('Y-m-d', strtotime("+" . $time_frame . " months",
            strtotime(date('Y-m-d'))));

        $patientRecall->update([
            'user_id'           => $user_id,
            'patient_id'        => $request->patient_id,
            'organization_id'   => $request->organization_id,
            'time_frame'        => $request->time_frame,
            'date_recall_due'   => $date_recall_due,
            'reason'            => $request->reason,
        ]);

        return response()->json(
            [
                'message' => 'Patient Recall updated',
                'data' => $patientRecall,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
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
