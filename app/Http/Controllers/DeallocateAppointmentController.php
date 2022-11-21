<?php

namespace App\Http\Controllers;

use App\Enum\UserRole;
use App\Http\Requests\DeallocateAppointmentIndexRequest;
use App\Models\Appointment;
use App\Models\HrmEmployeeLeave;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class DeallocateAppointmentController extends Controller
{
    public function index(DeallocateAppointmentIndexRequest $request)
    {
        $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
        $endDate = Carbon::parse($request->end_date)->format('Y-m-d');

        // Verify the user can access this function via policy
        $this->authorize('viewAny', [User::class, auth()->user()->organization_id]);

        $appointments = Appointment::where('organization_id', auth()->user()->organization_id)
            ->where('date', '>=', $startDate)
            ->where('date', '<=', $endDate)
            ->with(['specialist.employeeLeaves' => function ($query) use ($startDate, $endDate) {
                $query
                    ->where('status', 'Approved')
                    ->where('end_date', '>=', $startDate)
                    ->where('start_date', '<=', $endDate);
            }
            ])->with(['anesthetist.employeeLeaves' => function ($query) use ($startDate, $endDate) {
                $query
                    ->where('status', 'Approved')
                    ->where('end_date', '>=', $startDate)
                    ->where('start_date', '<=', $endDate);
            }
            ])
            ->get();

        $specialistsApt = array();
        $anesthetistsApt = array();
        foreach ($appointments as $apt) {
            foreach ($apt->specialist->employeeLeaves as $leave) {
                if ($apt->specialist_id == $leave->user_id
                    && $leave->start_date <= $apt->date
                    && $leave->end_date >= $apt->date) {
                    array_push($specialistsApt, $apt);
                }
            }
            if ($apt->anesthetist) {
                foreach ($apt->anesthetist->employeeLeaves as $leave) {
                    if ($apt->anesthetist_id == $leave->user_id
                        && $leave->start_date <= $apt->date
                        && $leave->end_date >= $apt->date) {
                        array_push($anesthetistsApt, $apt);
                    }
                }
            }

        }

        return response()->json(
            [
                'message' => 'Appointments with leaves',
                'specialistAppointments' => $specialistsApt,
                'anesthetistAppointments' => $anesthetistsApt,
            ],
            Response::HTTP_OK
        );
    }
}
