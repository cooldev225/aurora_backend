<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Appointment;


class UserAppointmentController extends BaseOrganizationController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $role = auth()->user()->role;

        if($role=='specialist'){
            $appointments = Appointment::where('specialist_id', auth()->user()->employee->specialist->id)->get();
        }

       
        return response()->json(
            [
                'message' => 'Appointment List',
                'data' => $appointments,
            ],
            Response::HTTP_OK
        );
    }

}
