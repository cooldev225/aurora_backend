<?php

namespace App\Http\Controllers;

use App\Enum\ProcedureApprovalStatus;
use App\Http\Requests\AppointmentProcedureApprovalRequest;
use App\Models\Appointment;

use App\Mail\Notification;


class AppointmentProcedureApprovalController extends BaseOrganizationController
{
    /**
     * [Appointment Procedure Approval] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anesthetist_employee_id = auth()->user()->employee->id;
        $today = date('Y-m-d');


        return response()->json(
            [
                'message' => 'Procedure Approval List',
                'data' => Appointment::
                            where('anesthetist_id', $anesthetist_employee_id)
                            ->where('procedure_approval_status', '!=', ProcedureApprovalStatus::NOT_RELEVANT)
                            ->where('date', '>=', $today)
                            ->orderBy('date')
                            ->orderBy('start_time')
                            ->get()
                            ->toArray()
            ],
            200
        );
    }

    /**
     * [Appointment Procedure Approval] - Update Status
     *
     * @param  \App\Http\Requests\AppointmentProcedureApprovalRequest  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(
        AppointmentProcedureApprovalRequest $request,
        Appointment $appointment
    ) {
        $appointment->procedure_approval_status = $request->procedure_approval_status;
        $appointment->save();
        $preadmission = $appointment->preAdmission;
        $preadmission->note = $request->note;
        $preadmission->save();

        if ($appointment->procedure_approval_status == ProcedureApprovalStatus::APPROVED) {
            Notification::sendAppointmentNotification($appointment, 'procedure_approved');
        } else {
            Notification::sendAppointmentNotification($appointment, 'procedure_denied'); 
        }

        return response()->json(
            [
                'message' => 'Appointment procedure approval request Updated',
                'data' => $appointment,
            ],
            200
        );
    }
}
