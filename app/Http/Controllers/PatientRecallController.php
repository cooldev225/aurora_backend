<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRecallIndexRequest;
use App\Http\Requests\PatientRecallRequest;
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
    public function index(PatientRecallIndexRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', PatientRecall::class);

        $recalls = PatientRecall::where('organization_id', auth()->user()->organization_id);

        $params = $request->validated();
        foreach ($params as $column => $param) {
            if (!empty($param)) {
                    $recalls = $recalls->where($column, '=', $param);                
            }
        }

        $recalls->with('sentLogs');

        return response()->json(
            [
                'message' => 'Patient Recall list',
                'data' => $recalls->get(),
            ],
            200
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
            ...$request->validated(),
            'user_id'           => auth()->user()->id,
            'organization_id'   => auth()->user()->organization_id,
            'date_recall_due'   => now()->addMonths($request->time_frame)->toDateString(),
            'confirmed'         => false,
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
            ...$request->validated(),
            'user_id'           => auth()->user()->id,
            'organization_id'   => auth()->user()->organization_id,
            'date_recall_due'   => now()->addMonths($request->time_frame)->toDateString(),
            'confirmed'         => false,
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
