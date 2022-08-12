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
