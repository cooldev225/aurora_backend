<?php

namespace App\Http\Controllers;

use App\Enum\UserRole;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;

class UserAppointmentController extends Controller
{
    /**
     * [User Appointment] - List
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('viewAny', Appointment::class);

        $role = auth()->user()->role->id;
        $organization_id = auth()->user()->organization_id;

        $appointments = [];
        if ($role === 5) {
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
