<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentDetailRequest;
use App\Models\Appointment;
use Illuminate\Http\Response;
use App\Http\Requests\AppointmentCheckCompletedRequest;

class AppointmentDetailController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AppointmentDetailRequest  $request
     * @param  \App\Models\AppointmentDetail  $AppointmentDetail
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentDetailRequest $request, Appointment $appointment)
    {
        $appointment->detail->update([...$request->validated()]);

        return response()->json(
            [
                'message' => 'Appointment details updated',
                'data' => $appointment,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Check the specified appointments are complted or not in date range.
     *
     * @param  \App\Http\Requests\AppointmentDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function checkAppointmentsComplete(AppointmentCheckCompletedRequest $request){
        // Verify the user can access this function via policy
        $this->authorize('viewAny', Appointment::class);

        $res = true;
        $appointments = Appointment::
            where('organization_id', auth()->user()->organization_id)
            ->with('detail')
            ->where('date', '>=', $request->from_date)
            ->where('date', '<=', $request->to_date)
            ->get();
        foreach($appointments as $appointment){
            if($appointment->detail->is_complete == 0){
                $res = false;
                break;
            }
        }
        return response()->json(
            [
                'message' => 'All appointments is ' . ($res?'completed':'uncompleted'),
                'data' => $res,
            ],
            Response::HTTP_OK
        );
    }
}
