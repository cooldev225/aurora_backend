<?php

namespace App\Http\Controllers;

use App\Enum\ConfirmationStatus;
use App\Enum\UserRole;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AppointmentSpecialistController extends Controller
{

    /**
     * [Specialist] - Work Hours By Today
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', [User::class, auth()->user()->organization_id]);

        $date = date('Y-m-d');
        if ($request->has('date')) {
            $date = Carbon::create($request->date)->toDateString();
        }

        $day = Carbon::create($request->date)->dayOfWeek;

        $specialists = User::
        where('organization_id', auth()->user()->organization_id)
        ->where('role_id', UserRole::SPECIALIST)
        ->whereHas('scheduleTimeslots', function($query) use ($day)
        {
            $query->where('week_day', $day);
        })
        ->with([
            'appointments' => function ($query) use ($date) {
                $query->where('date','=', $date)
                ->with('appointment_type')
                ->where('confirmation_status', '!=', ConfirmationStatus::CANCELED);
            }
        ])
        ->with([
            'scheduleTimeslots' => function ($query) use ($day) {
                $query->where('week_day', $day)
                ->with('anesthetist');
            }
        ])
        ->get();


        return response()->json(
            [
                'message' => 'Available Specialist On date' . $request->date,
                'data' => $specialists,
            ],
            Response::HTTP_OK
        );
    }

}
