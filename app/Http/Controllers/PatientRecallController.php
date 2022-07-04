<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\PatientRecall;
use App\Models\Patient;
use App\Http\Requests\PatientRecallRequest;

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
        $patient_table = (new Patient())->getTable();

        $patientRecalls = PatientRecall::where(
            'organization_id',
            $organization_id
        )
            ->leftJoin(
                $patient_table,
                'patient_id',
                '=',
                $patient_table . '.id'
            )
            ->orderByDesc('appointment_date')
            ->get();

        return response()->json(
            [
                'message' => 'Patient Recall List',
                'data' => $patientRecalls,
            ],
            Response::HTTP_OK
        );
    }
}
