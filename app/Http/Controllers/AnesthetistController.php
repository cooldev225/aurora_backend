<?php

namespace App\Http\Controllers;

use App\Enum\ConfirmationStatus;
use App\Enum\UserRole;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AnesthetistController extends Controller
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

        if ($request->day) {
            $day = ($request->day);
            $specialists = User::
            where('organization_id', auth()->user()->organization_id)
                ->where('role_id', UserRole::ANESTHETIST)
                ->whereHas('scheduleTimeslots', function ($query) use ($day) {
                    $query->where('week_day', $day);
                })
                ->with([
                    'scheduleTimeslots' => function ($query) use ($day) {
                        $query->where('week_day', $day);
                    }
                ])
                ->get();

        } else if ($request->date) {
            $date = Carbon::parse($request->date)->format('Y-m-d');
            $specialists = User::
            where('organization_id', auth()->user()->organization_id)
                ->where('role_id', UserRole::ANESTHETIST)
                ->whereHas('hrmWeeklySchedule', function ($query) use ($date) {
                    $query->where('date', $date)->where('status', "PUBLISHED");
                })
                ->with([
                    'hrmWeeklySchedule' => function ($query) use ($date) {
                        $query->where('date', $date)->where('status', "PUBLISHED");
                    }
                ])
                ->get();
        }

        return response()->json(
            [
                'message' => 'Available Anesthetists On date' . $request->date,
                'data' => $specialists,
            ],
            Response::HTTP_OK
        );
    }
}
