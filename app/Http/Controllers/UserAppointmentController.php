<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Appointment;


class UserAppointmentController extends Controller
{
    /**
     * [User Appointment] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $role = auth()->user()->role;
        $organization_id = auth()->user()->organization_id;

        $appointments = [];

        if ($role == 'Specialist') {
            $specialist_id = auth()->user()->id;
            $appointments = Appointment::where('organization_id', $organization_id)
                ->where('specialist_id', $specialist_id)
                ->get();
        } else if ($role == 'Anesthetist') {
            $specialist_id = auth()->user()->id;
            $appointments = Appointment::where('organization_id', $organization_id)
                ->where('specialist_id', $specialist_id)
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
