<?php

namespace App\Http\Controllers\Anesthetist;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Response;

class PatientController extends Controller
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
}
