<?php

namespace App\Http\Controllers;

use App\Models\Anesthetist;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AnesthetistController extends Controller
{
    /**
     * Display a listing of the appointments.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $employee = $user->employee;
        $appointments = Anesthetist::appointmentsByAnesthetist($employee->id);

        return response()->json(
            [
                'message'   => 'Anesthetist Appointment List',
                'data'      => $appointments,
            ],
            Response::HTTP_OK
        );
    }

    public function processPreAdmission(Request $request) {
        $appointment_id = $request->appointment_id;
        $appointment = Appointment::find($appointment_id);
        $appointment->procedure_approval_status = $request->status;
        $appointment->save();

        return response()->json(
            [
                'message'   => 'Anesthetist Appointment',
                'data'      => $appointment,
            ],
            Response::HTTP_OK
        );
    }
}
