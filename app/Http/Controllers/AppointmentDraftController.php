<?php

namespace App\Http\Controllers;
use App\Http\Requests\AppointmentDraftCreateRequest;
use App\Models\Appointment;
use App\Models\AppointmentType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AppointmentDraftController extends Controller
{
    public function store(AppointmentDraftCreateRequest $request)
    {
        // Verify the user can access this function via policy
        $this->authorize('create', Appointment::class);

        $startTime = Carbon::create($request->start_time);
        $appointment = Appointment::create([
            'date' => Carbon::create($request->date)->toDateString(),
            'arrival_time' => $request->arrival_time,
            'start_time' => $request->start_time,
            'end_time' => $this->aptEndTime($request)->toTimeString(),
            'organization_id' => auth()->user()->organization_id,
            'appointment_type_id' => $request->appointment_type_id,
            'clinic_id' => $request->clinic_id,
            'specialist_id' => $request->specialist_id,
            'anesthetist_id' => User::find($request->specialist_id)->hrmUserBaseSchedulesTimeDay($startTime->timestamp, strtoupper(Carbon::parse($request->date)->format('Y-m-d')))?->anesthetist_id,
            'note' => $request->note,
            'room_id' => $request->room_id,
            'draft_status' => true,
            'charge_type' => 'self-insured',
        ]);

        return response()->json(
            [
                'message' => 'New Appointment Draft created',
                'data' => $appointment,
            ],
            Response::HTTP_OK
        );
    }

    public function destroy(Appointment $appointment) {
        if (!$appointment->draft_status) {
            return abort(404);
        }
        $appointment->delete();
        $this->deleteDraftAppointments();
        return \response()->json([
            'message'=>"Draft appointment delete successfully",
            'data' => $appointment->id,
        ]);
    }

    private function aptEndTime(Request $request)
    {
        $startTime = Carbon::create($request->start_time);
        $organization = User::find($request->specialist_id)->organization()->first();
        $appointmentType = AppointmentType::where("id", $request->appointment_type_id)->first();
        return Carbon::create($startTime)->addMinutes($organization->appointment_length * $appointmentType->AppointmentLengthAsNumber);
    }

    private function deleteDraftAppointments()
    {
        Appointment::where('draft_status', true)
            ->where('created_at', '<', now()->subMinutes(10))->delete();
    }
}
