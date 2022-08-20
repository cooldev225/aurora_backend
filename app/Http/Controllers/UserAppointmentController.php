<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Appointment;


class UserAppointmentController extends BaseOrganizationController
{
    /**
     * [User Appointment] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $role = auth()->user()->role;

        $appointments = [];

        if ($role == 'Specialist') {
            $specialist_id = auth()->user()->employee->specialist->id;
            $appointments = Appointment::where('specialist_id', $specialist_id)
                ->get();
        } else if ($role == 'Anesthetist') {
            $specialist_id = auth()->user()->employee->specialist_from_anesthetist->id;
            $appointments = Appointment::where('specialist_id', $specialist_id)
                ->get();

        }

        return response()->json(
            [
                'message' => 'Appointment List',
                'data'    => $appointments,
            ],
            Response::HTTP_OK
        );
    }
}
