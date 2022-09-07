<?php

namespace App\Http\Controllers;

use App\Enum\ConfirmationStatus;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;

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

        if ($request->filled('specialist_ids')) {
            //aDD FILTER FOR SELECTED SPECIALISTS
        }

        $date = date('Y-m-d');
        if ($request->has('date')) {
            $date = date('Y-m-d', strtotime($request->date));
        }

        $day = date('D', strtotime($request->date));

        $specialists = User::
        where('organization_id', auth()->user()->organization_id)
        ->where('role_id', 5) // pull out to enum 
        ->whereHas('hrmUserBaseSchedules', function($query) use ($day)
        {
            $query->where('week_day', $day);
        })
        ->with([
            'appointments' => function ($query) use ($date) {
            $query->where('date','=', $date)
            ->where('confirmation_status', '!=', ConfirmationStatus::CANCELED);
            }
        ])
        ->with([
            'hrmUserBaseSchedules' => function ($query) use ($day) {
                $query->where('week_day', $day);
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
