<?php

namespace App\Http\Controllers;

use App\Enum\ProcedureApprovalStatus;
use App\Http\Requests\AppointmentProcedureApprovalRequest;
use Illuminate\Http\Response;
use App\Models\Appointment;

use App\Mail\Notification;


class AppointmentProcedureApprovalController extends BaseOrganizationController
{


       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anesthetist_employee_id = auth()->user()->employee->id;

        $today = date('Y-m-d');
        $patients = Appointment::withPreAdmission($anesthetist_employee_id)
            ->where('procedure_approval_status', '!=', ProcedureApprovalStatus::NOT_RELEVANT)
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

    /**
     * Update the Procedure Approval Status of an appointment.
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
        $appointment->pre_admission->note = $request->note;
        $appointment->pre_admission->save();

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
            Response::HTTP_OK
        );
    }
}
