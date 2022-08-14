<?php

namespace App\Http\Controllers\Anesthetist;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProcedureApprovalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anesthetist_id = auth()->user()->id;
        $anesthetist = User::find($anesthetist_id);

        if ($anesthetist == null) {
            return response()->json(
                [
                    'message' => 'Patient List',
                    'data' => [],
                ],
                Response::HTTP_OK
            );
        }

        $anesthetist_employee_id = $anesthetist->employee->id;

        $today = date('Y-m-d');
        $patients = Appointment::withPreAdmission($anesthetist_employee_id)
            ->where('date', '>=', $today)
            ->orderBy('date')
            ->orderBy('start_time')
            ->get()
            ->toArray();

        return response()->json(
            [
                'message' => 'Patient List',
                'data' => $patients,
            ],
            Response::HTTP_OK
        );
    }

    public function updateStatus(Request $request) {
        $appointment_id = $request->appointment_id;
        $status = $request->procedure_approval_status;

        $appointment = Appointment::find($appointment_id);

        if ($appointment == null) {
            return response()->json(
                [
                    'message' => 'Not found Procedure Approval',
                    'data'    => $appointment,
                ],
                Response::HTTP_OK
            );
        }

        $appointment->procedure_approval_status = $status;
        $appointment->save();
        $pre_admission = $appointment->pre_admission;
        $pre_admission->note = $request->notes;
        $pre_admission->save();

        return response()->json(
            [
                'message' => 'Procedure Approval Status Updated',
                'data'    => $appointment,
            ],
            Response::HTTP_OK
        );
    }
}
