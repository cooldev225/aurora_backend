<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRecallRequest;
use App\Models\Patient;
use Illuminate\Http\Response;
use App\Models\PatientRecall;

class PatientRecallController extends Controller
{
    /**
     * [Recall - List]
     *
     * Returns a list of all the recalls set for the patient
     * 
     * @group Patients
     * @return \Illuminate\Http\Response
     * @responseFile storage/responses/patients.recall.list.json
     */
    public function index(Patient $patient)
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', PatientRecall::class);

        return response()->json(
            [
                'message' => 'Patient Recall list',
                'data' => $patient->recalls,
            ],
            Response::HTTP_CREATED
        );
    }
    
    /**
     * [Recall] - Store
     *
     * @group Patients
     * @param  \App\Http\Requests\PatientRecallRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRecallRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', PatientRecall::class);

        $patientRecall = PatientRecall::create([
            'user_id'           => auth()->user()->id,
            'patient_id'        => $request->patient_id,
            'appointment_id'    => $request->appointment_id,
            'organization_id'   => $request->user()->organization_id,
            'date_recall_due'   => now()->addMonths($request->time_frame)->toDateString(),
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
     * [Recall] - Update
     *
     * @group Patients
     * @param  \App\Http\Requests\PatientRecallRequest  $request
     * @param  \App\Models\PatientRecall  $patientRecall
     * @return \Illuminate\Http\Response
     */
    public function update(
        PatientRecallRequest $request,
        PatientRecall $patientRecall
    ) {
        // Verify the user can access this function via policy
        $this->authorize('update', $patientRecall);

        $patientRecall->update([
            'user_id'           => auth()->user()->id,
            'patient_id'        => $request->patient_id,
            'organization_id'   => $request->user()->organization_id,
            'date_recall_due'   => now()->addMonths($request->time_frame)->toDateString(),
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
     * [Recall] - Destroy
     *
     * @group Patients
     * @param  \App\Models\PatientRecall  $patientRecall
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientRecall $patientRecall)
    {
        // Verify the user can access this function via policy
        $this->authorize('delete', $patientRecall);
    
        $patientRecall->delete();

        return response()->json(
            [
                'message' => 'Patient Recall Removed',
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
