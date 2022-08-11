<?php

namespace App\Http\Controllers;
use App\Http\Requests\AppointmentProcedureApprovalRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Http\Requests\AppointmentRequest;

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

        return response()->json(
            [
                'message' => 'Appointment procedure approval request Updated',
                'data' => $appointment,
            ],
            Response::HTTP_OK
        );
    }
}
